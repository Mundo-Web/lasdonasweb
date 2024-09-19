<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\DetalleOrden;
use App\Models\General;
use App\Models\HistoricoCupon;
use App\Models\Offer;
use App\Models\Ordenes;
use App\Models\PrecioEnvio;
use App\Models\Price;
use App\Models\Products;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use App\Services\InstagramService;
use Culqi\Culqi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SoDe\Extend\JSON;
use SoDe\Extend\Math;
use SoDe\Extend\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use SoDe\Extend\Crypto;
use SoDe\Extend\File;
use Carbon\Carbon;
use SoDe\Extend\Trace;

class PaymentController extends Controller
{
  public function culqi(Request $request)
  {
    $body = $request->all();
    $response = new Response();
    $culqi = new Culqi(['api_key' => env('CULQI_PRIVATE_KEY')]);

    $body['address']['entrega'];
    $fechaEntrega = $body['address']['entrega']['fecha'];
    $horarioEntrega = $body['address']['entrega']['horario'];





    $sale = new Ordenes();

    try {

      $products = $body['cart'];
      $generals = General::select('point_equivalence')->first();

      $productsJpa = Products::select(['id', 'imagen', 'producto', 'precio', 'descuento', 'puntos_complemento', 'tipo_servicio'])
        ->whereIn('id', array_map(fn($x) => $x['id'], $products))
        ->get();

      $restPoints = Auth::check() ? Auth::user()->points : 0;
      $totalCost = 0;
      $points2discount = 0;

      $details = [];

      foreach ($productsJpa as $productJpa) {
        $key = array_search($productJpa->id, array_column($body['cart'], 'id'));
        $finalQuantity = $body['cart'][$key]['quantity'];
        $finalPrice = $productJpa->descuento > 0 ? $productJpa->descuento :  $productJpa->precio;

        $points_used = 0;
        for ($i = 0; $i < $body['cart'][$key]['quantity']; $i++) {
          if ($body['cart'][$key]['usePoints'] && $restPoints >= $productJpa->puntos_complemento) {
            $finalQuantity--;
            $points2discount += $productJpa->puntos_complemento;
            $points_used += $productJpa->puntos_complemento;
            $restPoints -= $productJpa->puntos_complemento;
          } else break;
        }

        $totalCost += $finalPrice * $finalQuantity;

        $details[] = [
          'producto_id' => $productJpa->id,
          'name' => $productJpa->producto,
          'imagen' => $body['cart'][$key]['imagen'],
          'cantidad' => $body['cart'][$key]['quantity'],
          'precio' => $finalPrice,
          'price_used' => $finalPrice * $finalQuantity,
          'points' => $productJpa->puntos_complemento ?? 0,
          'points_used' => $points_used,
        ];
      }


      $precioEnvioJpa = PrecioEnvio::where('zip_code', $body['address']['postal_code'])->first();
      $precioEnvio = $precioEnvioJpa->price;

      $historicoCupon = HistoricoCupon::with('cupon')
        ->where('user_id', Auth::user()->id)
        ->where('usado', 0)
        ->first();

      $descuento = 0;


      if ($historicoCupon) {
        $cupon = $historicoCupon->cupon;
        if ($cupon->porcentaje == 1) {

          $descuento += ($totalCost) * ($cupon->monto / 100);
        } else {

          $descuento += $cupon->monto;
        }
        $historicoCupon->usado = true;
        $historicoCupon->save();
      }

      $points2give = Math::floor(($totalCost + $precioEnvio - $descuento) / $generals->point_equivalence);

      $sale->usuario_id = Auth::user()?->id ?? null;
      $sale->status_id = 1;
      $sale->codigo_orden = '00000000';
      $sale->points = $points2give;
      $sale->tipo_tarjeta = $body['culqi']['iin']['card_type'] . ' - ' . $body['culqi']['iin']['card_brand'];
      $sale->numero_tarjeta = $body['culqi']['card_number'];
      $sale->culqi_data = JSON::stringify($body['culqi']);
      $sale->address_full = $body['address']['street'] . ', ' . $body['address']['district'] . ' ' . $body['address']['postal_code'];
      $sale->address_owner = $body['address']['fullname'];
      $sale->address_zipcode = $body['address']['postal_code'];
      $sale->address_latitude = $body['address']['coordinates']['latitude'];
      $sale->address_longitude = $body['address']['coordinates']['longitude'];
      $sale->address_data = JSON::stringify($body['address']);
      $sale->precio_envio = $precioEnvio;
      $sale->monto = $totalCost - $descuento;
      $sale->billing_type = $body['billing']['type'];
      $sale->billing_document = $body['billing']['type'] == 'boleta' ? $body['billing']['dni'] : $body['billing']['ruc'];
      $sale->billing_name = $body['billing']['name']; // . ' ' . $body['billing']['lastname'];
      $sale->billing_address = $body['billing']['address'] ?? '';
      $sale->billing_email = $body['billing']['email'];
      $sale->consumer_phone = $body['consumer']['phone'];
      $sale->dedication_id = $body['dedication']['id'] ?? null;
      $sale->dedication_title = $body['dedication']['title'] ?? null;
      $sale->dedication_message = $body['dedication']['message'] ?? null;
      $sale->dedication_sign = $body['dedication']['sign'] ?? null;
      $sale->fechaenvio = $fechaEntrega;
      $sale->horario_envio = $horarioEntrega;
      $sale->to = $body['dedication']['to'] ?? null;
      $sale->from = $body['dedication']['from'] ?? null;

      if ($body['dedication']['image']) {
        try {
          $sale->dedication_image = $this->saveDedicationImage($body['dedication']['image']);
        } catch (\Throwable $th) {
          $sale->dedication_image = null;
        }
      }




      $sale->save();

      foreach ($details as $detail) {
        DetalleOrden::create([
          ...$detail,
          'orden_id' => $sale->id
        ]);
      }




      $config = [
        "amount" => round(($totalCost + $precioEnvio - $descuento) * 100),
        "capture" => true,
        "currency_code" => "PEN",
        "description" => "Compra en " . env('APP_NAME'),
        "email" => $body['culqi']['email'] ?? $body['billing']['email'],
        "installments" => 0,
        "antifraud_details" => [
          "address" => $body['address']['street'],
          "address_city" => $body['address']['district'],
          "country_code" => "PE",
          "first_name" => $body['billing']['name'],
          // "last_name" => $body['billing']['lastname'] ?? $body['billing']['name'],
          "last_name" => $body['billing']['name'],
          "phone_number" => $body['consumer']['phone'],
        ],
        "source_id" => $body['culqi']['id']
      ];


      $charge = $culqi->Charges->create($config);

      if (gettype($charge) == 'string') {
        $res = JSON::parse($charge);
        throw new Exception($res['user_message']);
      }

      $response->status = 200;
      $response->message = "Cargo creado correctamente";
      $response->data = [
        'charge' => $charge,
        'reference_code' => $charge?->reference_code ?? null,
        'amount' => $totalCost - $descuento,
      ];

      $userJpa = User::find(Auth::user()->id);
      $userJpa->points = Auth::user()->points + ($points2give - $points2discount);
      $userJpa->save();

      if ($sale->points > 0) {
        MailingController::notifyPoints($userJpa, $sale);
      }

      $sale->status_id = 3;
      $sale->codigo_orden = $charge?->reference_code ?? null;

      // $indexController = new IndexController(new InstagramService());
      // $datacorreo = [
      //   'nombre' => $sale->name . ' ' . $sale->lastname,

      //   'email' => $sale->email,

      // ];
      // $indexController->envioCorreoCompra($datacorreo);
    } catch (\Throwable $th) {
      $response->status = 400;
      $response->message = $th->getMessage();

      if (!$sale->codigo_orden) {
        $sale->codigo_orden = '000000000000';
      }
      $sale->status_id = 2;
    } finally {

      $sale->save();
      return response($response->toArray(), $response->status);
    }
  }

  public function saveDedicationImage($file)
  {
    try {
      [$first, $code] = explode(';base64,', $file);
      $imageData = base64_decode($code);
      $routeImg = 'storage/images/dedication/';
      $ext = File::getExtention(str_replace("data:", '', $first));
      $nombreImagen = Crypto::randomUUID() . '.' . $ext;
      if (!file_exists($routeImg)) {
        mkdir($routeImg, 0777, true);
      }
      file_put_contents($routeImg . $nombreImagen, $imageData);
      return $routeImg . $nombreImagen;
    } catch (\Throwable $th) {
      return null;
    }
  }

  public function pagarConTransferencia(Request $request)
  {
    $body = $request->all();
    $response = new Response();


    $fechaEntrega = $body['address']['entrega']['fecha'];
    $horarioEntrega = $body['address']['entrega']['horario'];

    $sale = new Ordenes();

    $codigoOrden = Trace::getId( false);

    try {

      $products = $body['cart'];
      $generals = General::select('point_equivalence')->first();

      $productsJpa = Products::select(['id', 'imagen', 'producto', 'precio', 'descuento', 'puntos_complemento', 'tipo_servicio'])
        ->whereIn('id', array_map(fn($x) => $x['id'], $products))
        ->get();

      $restPoints = Auth::check() ? Auth::user()->points : 0;
      $totalCost = 0;
      $points2discount = 0;

      $details = [];

      foreach ($productsJpa as $productJpa) {
        $key = array_search($productJpa->id, array_column($body['cart'], 'id'));
        $finalQuantity = $body['cart'][$key]['quantity'];
        $finalPrice = $productJpa->descuento > 0 ? $productJpa->descuento :  $productJpa->precio;
        $points_used = 0;
        for ($i = 0; $i < $body['cart'][$key]['quantity']; $i++) {
         
          if ($body['cart'][$key]['usePoints'] !== "false" && $restPoints >= $productJpa->puntos_complemento) {
            
            $finalQuantity--;
            $points2discount += $productJpa->puntos_complemento;
            $points_used += $productJpa->puntos_complemento;
            $restPoints -= $productJpa->puntos_complemento;
          } else break;
        }
        


        $totalCost += $finalPrice * $finalQuantity;
        
        $details[] = [
          'producto_id' => $productJpa->id,
          'name' => $productJpa->producto,
          'imagen' => $body['cart'][$key]['imagen'],
          'cantidad' => $body['cart'][$key]['quantity'],
          'precio' => $finalPrice,
          'price_used' => $finalPrice * $finalQuantity,
          'points' => $productJpa->puntos_complemento ?? 0,
          'points_used' => $points_used,
        ];
      }


      $precioEnvioJpa = PrecioEnvio::where('zip_code', $body['address']['postal_code'])->first();
      $precioEnvio = $precioEnvioJpa->price;

      $historicoCupon = HistoricoCupon::with('cupon')
        ->where('user_id', Auth::user()->id)
        ->where('usado', 0)
        ->first();

      $descuento = 0;


      if ($historicoCupon) {
        $cupon = $historicoCupon->cupon;
        if ($cupon->porcentaje == 1) {

          $descuento += ($totalCost) * ($cupon->monto / 100);
        } else {

          $descuento += $cupon->monto;
        }
        $historicoCupon->usado = true;
        $historicoCupon->save();
      }

      // $points2give = Math::floor(($totalCost + $precioEnvio - $descuento) / $generals->point_equivalence);
      $points2give = 0;

      $sale->usuario_id = Auth::user()?->id ?? null;
      $sale->status_id = 1;
      $sale->codigo_orden = $codigoOrden;
      $sale->points = $points2give;
      $sale->tipo_tarjeta = 'transferencia';
      $sale->numero_tarjeta = '';
      $sale->culqi_data = JSON::stringify([]);
      $sale->address_full = $body['address']['street'] . ', ' . $body['address']['district'] . ' ' . $body['address']['postal_code'];
      $sale->address_owner = $body['address']['fullname'];
      $sale->address_zipcode = $body['address']['postal_code'];
      $sale->address_latitude = $body['address']['coordinates']['latitude'];
      $sale->address_longitude = $body['address']['coordinates']['longitude'];
      $sale->address_data = JSON::stringify($body['address']);
      $sale->precio_envio = $precioEnvio;
      $sale->monto = $totalCost - $descuento;
      $sale->billing_type = $body['billing']['type'];
      $sale->billing_document = $body['billing']['type'] == 'boleta' ? $body['billing']['dni'] : $body['billing']['ruc'];
      $sale->billing_name = $body['billing']['name']; // . ' ' . $body['billing']['lastname'];
      $sale->billing_address = $body['billing']['address'] ?? '';
      $sale->billing_email = $body['billing']['email'];
      $sale->consumer_phone = $body['consumer']['phone'];
      $sale->dedication_id = $body['dedication']['id'] ?? null;
      $sale->dedication_title = $body['dedication']['title'] ?? null;
      $sale->dedication_message = $body['dedication']['message'] ?? null;
      $sale->dedication_sign = $body['dedication']['sign'] ?? null;
      $sale->fechaenvio = $fechaEntrega;
      $sale->horario_envio = $horarioEntrega;
      $sale->to = $body['dedication']['to'] ?? null;
      $sale->from = $body['dedication']['from'] ?? null;
      $sale->puntos_calculados = false;

      if (isset($body['img'])) {
        try {
          $sale->img_transferencia = $this->saveDedicationImage($body['img']);
        } catch (\Throwable $th) {
          $sale->img_transferencia = null;
        }
      }




      $sale->save();

      foreach ($details as $detail) {
        DetalleOrden::create([
          ...$detail,
          'orden_id' => $sale->id
        ]);
      }


      $response->status = 200;
      $response->message = "Cargo creado correctamente";
      $response->data = [
        
        'reference_code' => $codigoOrden ?? null,
        'amount' => $totalCost - $descuento,
      ];

      $userJpa = User::find(Auth::user()->id);
      $userJpa->points = Auth::user()->points + ($points2give - $points2discount);
      $userJpa->save();

      if ($sale->points > 0) {
        // MailingController::notifyPoints($userJpa, $sale);
      }

      // $sale->status_id = 3;
      $sale->codigo_orden = $codigoOrden ?? null;

      // $indexController = new IndexController(new InstagramService());
      // $datacorreo = [
      //   'nombre' => $sale->name . ' ' . $sale->lastname,

      //   'email' => $sale->email,

      // ];
      // $indexController->envioCorreoCompra($datacorreo);

    } catch (\Throwable $th) {
      //throw $th;
      $response->status = 400;
      $response->message = $th->getMessage();

      if (!$sale->codigo_orden) {
        $sale->codigo_orden = '000000000000';
      }
      $sale->status_id = 2;
      
    } finally {

      $sale->save();
      return response($response->toArray(), $response->status);
    }
    // $data = json_decode($request->datosFinales) ;

  }
}
