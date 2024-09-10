<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Http\Requests\StoreIndexRequest;
use App\Http\Requests\UpdateIndexRequest;
use App\Models\AboutUs;
use App\Models\Address;
use App\Models\AddressUser;
use App\Models\Attributes;
use App\Models\AttributesValues;
use App\Models\Faqs;
use App\Models\General;
use App\Models\Index;
use App\Models\Message;
use App\Models\Products;
use App\Models\Slider;
use App\Models\Strength;
use App\Models\Testimony;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Combinacion;
use App\Models\Complemento;
use App\Models\Cupon;
use App\Models\DetalleOrden;
use App\Models\Greeting;
use App\Models\HistoricoCupon;
use App\Models\Horarios;
use App\Models\ImagenProducto;
use App\Models\Liquidacion;
use App\Models\MensajesPredefinidos;
use App\Models\Ordenes;
use App\Models\PoliticaSustitucion;
use App\Models\PolyticsCondition;
use App\Models\Price;
use App\Models\Specifications;
use App\Models\Tag;
use App\Models\TermsAndCondition;
use App\Models\Tipo;
use App\Models\TipoFlor;
use App\Models\User;
use App\Models\UserDetails;
use App\Services\InstagramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Carbon\Carbon;

class IndexController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  protected $instagramService;

  public function __construct(InstagramService $instagramService)
  {
    $this->instagramService = $instagramService;
  }

  public function index()
  {
    // $productos = Products::all(); Products::where("tipo_servicio", "=", 'complemento')
    $productos = Products::where('status', '=', 1)->where('destacar', 1)->with(['images','componentesHijos']) ->where('tipo_servicio', 'producto')->with('tags')->get();
    $categorias = Category::all();
    $destacados = Products::where('destacar', '=', 1)->where('status', '=', 1)->where('tipo_servicio', 'producto')->where('visible', '=', 1)->with('tags')->with(['images','componentesHijos'])->get();
    $recomendados = Products::where('recomendar', '=', 1)->where('status', '=', 1)->where('tipo_servicio', 'producto')->where('visible', '=', 1)->with('tags')->with(['images','componentesHijos'])->get();
    // $descuentos = Products::where('descuento', '>', 0)->where('status', '=', 1)
    // ->where('visible', '=', 1)->with('tags')->get();
    // $newarrival = Products::where('recomendar', '=', 1)->where('status', '=', 1)->where('visible', '=', 1)->with('tags')->with('images')->get();

    
    $general = General::find(1);
    $benefit = Strength::where('status', '=', 1)->get();
    $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
    $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
    $slider = Slider::where('status', '=', 1)->where('visible', '=', 1)->get();
    $categoriasindex = Category::where('status', '=', 1)->where('destacar', '=', 1)->get();
    $liquidacion = Liquidacion::where('status', '=', 1)->where('visible', '=', 1)->get();

    $media = $this->instagramService->getUserMedia();


    return view('public.index', compact('media', 'productos', 'destacados', 'recomendados', 'general', 'benefit', 'faqs', 'testimonie', 'slider', 'categorias', 'categoriasindex', 'liquidacion'));
  }

  public function coleccion($filtro)
  {
    try {
      $collections = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

      if ($filtro == 0) {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();
      } else {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('collection_id', '=', $filtro)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->first();
      }

      return view('public.collection', compact('filtro', 'productos', 'collection', 'collections'));
    } catch (\Throwable $th) {
    }
  }

  public function catalogoFiltroAjax(Request $request)
  {
    $productos = Products::obtenerProductos();
    $page = 0;
    if (!empty($productos->nextPageUrl())) {
      $parse_url = parse_url($productos->nextPageUrl());

      if (!empty($parse_url['query'])) {
        parse_str($parse_url['query'], $get_array);
        $page = !empty($get_array['page']) ? $get_array['page'] : 0;
      }
    }

    return response()->json(
      [
        'status' => true,
        'page' => $page,
        'success' => view('public._listproduct', [
          'productos' => $productos,
        ])->render(),
      ],
      200,
    );
  }

  public function catalogo(Request $request, ?string $filtro = null)
  {
    $categorias = null;
    $productos = null;

    // $rangefrom = $request->query('rangefrom');
    // $rangeto = $request->query('rangeto');
    // $tituloAtributo = $request->query('rangeto');
    // $valorAtributo = $request->query('rangeto');
    // dd($request);
    try {
      $general = General::all();
      $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
      $categorias = Category::select('categories.*')
        ->join('products', 'products.categoria_id', '=', 'categories.id')
        ->where('categories.status', '=', 1)
        ->where('categories.visible', '=', 1)
        ->groupBy('categories.id')
        ->get();
      $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
      $atributos = Attributes::where('status', '=', 1)->where('visible', '=', 1)->get();
      $colecciones = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

      if ($filtro == 0) {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
        $productos = Products::obtenerProductos();

        $categoria = Category::all();
        $filtro = null;
      } else {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
        $productos = Products::obtenerProductos($filtro);

        $categoria = Category::findOrFail($filtro);
      }

      $page = 0;
      if (!empty($productos->nextPageUrl())) {
        $parse_url = parse_url($productos->nextPageUrl());

        if (!empty($parse_url['query'])) {
          parse_str($parse_url['query'], $get_array);
          $page = !empty($get_array['page']) ? $get_array['page'] : 0;
        }
      }
      $beneficios = Strength::where('status', '=', 1)->get();
      $tipoFlores = TipoFlor::select('tipo_flors.*')->join('products', 'products.tipo_flor_id', '=', 'tipo_flors.id')->where('tipo_flors.status', '=', 1)->groupBy('tipo_flors.id')->get();


      // return view('public.catalogo', compact('general', 'faqs', 'categorias', 'testimonie', 'filtro', 'productos', 'categoria', 'atributos', 'colecciones', 'page'));
      return Inertia::render('Catalogo', [
        'general' => $general,
        'faqs' => $faqs,
        'categorias' => $categorias,
        'testimonie' => $testimonie,
        'selected_category' => $filtro,
        'productos' => $productos,
        'categoria' => $categoria,
        'atributos' => $atributos,
        'colecciones' => $colecciones,
        'tipoFloresList' => $tipoFlores,
        'page ' => $page,
        'url_env' => $_ENV['APP_URL'],

        'beneficios' => $beneficios,
      ])->rootView('app');
    } catch (\Throwable $th) {
      // dump($th);
    }
  }

  public function comentario()
  {
    $comentarios = Testimony::where('status', '=', 1)->where('visible', '=', 1)->paginate(15);
    $contarcomentarios = count($comentarios);
    return view('public.comentario', compact('comentarios', 'contarcomentarios'));
  }

  public function hacerComentario(Request $request)
  {
    $user = auth()->user();

    $newComentario = new Testimony();
    if (isset($user)) {
      $alert = null;
      $request->validate(
        [
          'testimonie' => 'required',
        ],
        [
          'testimonie.required' => 'Ingresa tu comentario',
        ],
      );

      $newComentario->name = $user->name;
      $newComentario->testimonie = $request->testimonie;
      $newComentario->visible = 0;
      $newComentario->status = 1;
      $newComentario->email = $user->email;
      $newComentario->save();

      $mensaje = 'Gracias. Tu comentario pasará por una validación y será publicado.';
      $alert = 1;
    } else {
      $alert = 2;
      $mensaje = 'Inicia sesión para hacer un comentario';
    }

    return redirect()
      ->route('comentario')
      ->with(['mensaje' => $mensaje, 'alerta' => $alert]);
  }

  public function contacto()
  {
    $general = General::all();
    return view('public.contact', compact('general'));
  }

  public function carrito()
  {
    $complementos  = Tag::withCount(['complements'])
      ->where('tags.status', '=', 1)
      ->join('tags_xproducts', 'tags_xproducts.tag_id', 'tags.id')
      ->where('tags.visible', '=', 1)
      ->having('complements_count', '>', 0)
      ->groupBy('tags.id')
      ->get();

    $historicoCupones = [];

    if (Auth::check()) {
      $usuario = Auth::user()->id;
      $historicoCupones = HistoricoCupon::with('cupon')->where('user_id', $usuario)->where('usado', false)->get();
    }

    // $historicoCupones = HistoricoCupon::with('cupon')->where('user_id', Auth::user()->id)->where('usado', false)->get();

    /* $complementos = Complemento::select('complementos.*')
      ->join('products', 'products.complemento_id', '=', 'complementos.id')
      ->where('complementos.status', 1)
      ->groupBy('complementos.id')
      ->get();
    foreach ($complementos as $key => $complemento) {

      $complementos[$key]['min_price'] = $complemento->min_price;
    } */

    // return view('public.checkout_carrito', compact('url_env', 'departamentos'));
    return Inertia::render('Carrito', [
      'complementos' => $complementos,
      'points' => Auth::check() ? Auth::user()->points : 0,
      'historicoCupones' => $historicoCupones
    ])->rootView('app');
  }

  public function pago(Request $request)
  {
    //
    //
    $detalleUsuario = [];
    $user = auth()->user();

    if (!is_null($user)) {
      $detalleUsuario = UserDetails::where('email', $user->email)->get();
    }

    $historicoCupones = [];

    if (Auth::check()) {
      $usuario = Auth::user()->id;
      $historicoCupones = HistoricoCupon::with('cupon')->where('user_id', $usuario)->where('usado', false)->get();
    }


    // $departamento = DB::select('select * from departments where active = ? order by 2', [1]);
    /* $departments = Price::select([
      'departments.id AS id',
      'departments.description AS description',
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->join('provinces', 'provinces.id', 'districts.province_id')
      ->join('departments', 'departments.id', 'provinces.department_id')
      ->where('departments.active', 1)
      ->where('status', 1)
      ->groupBy('id', 'description')
      ->get(); */

    /* $provinces = Price::select([
      'provinces.id AS id',
      'provinces.description AS description',
      'provinces.department_id AS department_id'
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->join('provinces', 'provinces.id', 'districts.province_id')
      ->where('provinces.active', 1)
      ->groupBy('id', 'description', 'department_id')
      ->get(); */

    /*  $districts = Price::select([
      'districts.id AS id',
      'districts.description AS description',
      'districts.province_id AS province_id',
      'prices.id AS price_id',
      'prices.price AS price'
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->where('districts.active', 1)
      ->groupBy('id', 'description', 'province_id', 'price', 'price_id')
      ->get(); */

    // $distritos  = DB::select('select * from districts where active = ? order by 3', [1]);
    // $provincias = DB::select('select * from provinces where active = ? order by 3', [1]);

    $categorias = Category::all();

    $destacados = Products::where('destacar', '=', 1)->where('status', '=', 1)
      ->where('visible', '=', 1)->with('tags')->activeDestacado()->get();


    $url_env = env('APP_URL');
    $culqi_public_key = env('CULQI_PUBLIC_KEY');

    $addresses = [];
    $hasDefaultAddress = false;
    /* if (Auth::check()) {
        $addresses = Address::with([
          'price',
          'price.district',
          'price.district.province',
          'price.district.province.department'
        ])
          ->where('email', $user->email)
          ->get();
        $hasDefaultAddress = Address::where('email', $user->email)
          ->where('isDefault', true)
          ->exists();
      } */
    // $MensajesPredefinidos = MensajesPredefinidos::where('status', '=', 1)->where('visible', '=', 1)->get();
    $greetings = Greeting::where('status', true)->where('visible', true)->get();

    $url_env = $_ENV['APP_URL'];
    return Inertia::render('Pago', [
      'url_env' => $url_env,
      'app_name' => env('APP_NAME'),
      'detalleUsuario' => $detalleUsuario,
      'categorias' => $categorias,
      'destacados'  => $destacados,
      'culqi_public_key' => $culqi_public_key,
      'addresses' => $addresses,
      // 'MensajesPredefinidos' => $MensajesPredefinidos,
      'greetings' => $greetings,
      'points' => Auth::check() ? Auth::user()->points : 0,
      'historicoCupones' => $historicoCupones
    ])->rootView('app');
  }

  private function generateFormTokenIzipay($amount, $orderId, $email)
  {
    $clientId = config('services.izipay.client_id');
    $clientSecret = config('services.izipay.client_secret');
    $auth = base64_encode($clientId . ':' . $clientSecret);

    $url = config('services.izipay.url');
    $response = Http::withHeaders([
      'Authorization' => "Basic $auth",
      'Content-Type' => 'application/json',
    ])
      ->post($url, [
        'amount' => $amount * 100,
        'currency' => 'PEN',
        'orderId' => $orderId,
        'customer' => [
          'email' => $email,
        ],
      ])
      ->json();

    $token = $response['answer']['formToken'];
    return $token;
  }

  public function procesarPago(Request $request)
  {
    $codigoCompra = $request->codigoCompra;
    $dataArray = $request->data;
    $result = [];

    $codigoAleatorio = '';
    foreach ($dataArray as $item) {
      $result[$item['name']] = $item['value'];
    }
    $tipoTarjeta = $result['tipo_tarjeta'];

    try {
      $reglasPrimeraCompra = [
        'email' => 'required',
      ];
      $mensajes = [
        'email.required' => 'El campo Email es obligatorio.',
      ];
      // $request->validate($reglasPrimeraCompra, $mensajes);

      $orden = Ordenes::where('codigo_orden', '=', $codigoCompra);

      $orden->update(['tipo_tarjeta' => $tipoTarjeta]);

      $ordenid = $orden->get();
      AddressUser::where('id', $ordenid[0]['address_id'])->update([
        'dir_av_calle' => $result['dir_av_calle'],
        'dir_numero' => $result['dir_numero'],
        'dir_bloq_lote' => $result['dir_bloq_lote']
      ]);


      UserDetails::where('email', '=', $request->email)->update($result);

      return response()->json(['message' => 'Todos los datos estan correctos', 'codigoCompra' => $codigoAleatorio]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => $th], 400);
    }
  }

  private function guardarOrden()
  {
    //almacenar venta, generar orden de pedido , guardar en tabla detalle de compra, li
  }

  private function codigoVentaAleatorio()
  {
    $codigoAleatorio = '';

    // Longitud deseada del código
    $longitudCodigo = 10;

    // Genera un código aleatorio de longitud 10
    for ($i = 0; $i < $longitudCodigo; $i++) {
      $codigoAleatorio .= mt_rand(0, 9); // Agrega un dígito aleatorio al código
    }
    return $codigoAleatorio;
  }

  public function agradecimiento(Request $request)
  {
    $codigo_orden = $request->input('code');

    if (!$codigo_orden) return redirect('/');
    $ordenJpa = Ordenes::where('codigo_orden', $codigo_orden)->first();

    return Inertia::render('Agradecimiento', [
      'orden_code' => $codigo_orden,
      'orden' => $ordenJpa
    ])->rootView('app');
  }
   public function nosotros(){
    $general = General::all();
    $nosotros = AboutUs::all(); 
    return Inertia::render('Nosotros', [
      'general' => $general,
      'nosotros' => $nosotros
      
    ])->rootView('app');
   }

  public function cambiofoto(Request $request)
  {
    $user = User::findOrFail(Auth::user()->id);

    if ($request->hasFile("image")) {

      $file = $request->file('image');
      $route = 'storage/images/users/';
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

      if (File::exists(storage_path() . '/app/public/' . $user->profile_photo_path)) {
        File::delete(storage_path() . '/app/public/' . $user->profile_photo_path);
      }

      $this->saveImg2($file, $route, $nombreImagen);

      $routeforshow = 'images/users/';
      $user->profile_photo_path = $route . $nombreImagen;
    }
    $user->save();
    return response()->json(['message' => 'La imagen se cargó correctamente.']);
  }

  public function saveImg2($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img =  $manager->read($file);

    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }
    $img->save($route . $nombreImagen);
  }
 

  public function actualizarPerfil(Request $request)
  {


    $name = $request->name;
    $lastname = $request->lastname;
    $email = $request->email;
    $phone = $request->phone;
    $direccion = $request->direccion;
    $departamento = $request->departamento;
    $provincia = $request->provincia;
    $distrito = $request->distrito;
    $codigo_postal = $request->codigo_postal;

    $user = User::findOrFail($request->id);

    $imprimir = '';
    $imrimirPassword = '';

    if ($request->password !== null || $request->newpassword !== null || $request->confirmnewpassword !== null) {
      if (!Hash::check($request->password, $user->password)) {
        $imrimirPassword = "La contraseña actual no es correcta";
        $alert = "error";
      } else {
        $user->password = Hash::make($request->newpassword);
        $imrimirPassword = "Cambio de contraseña exitosa";
        $alert = "success";
      }
    }


    if ($user->name == $name &&  $user->lastname == $lastname && $user->email == $email && $user->phone == $phone) {
      $imprimir = "Sin datos que actualizar";
      $alert = "question";
    } else {
      $user->name = $name;
      $user->lastname = $lastname;
      $user->email = $email;
      $user->phone = $phone;

      $user->direccion = $direccion;
      $user->departamento = $departamento;
      $user->provincia = $provincia;
      $user->distrito = $distrito;
      $user->codigo_postal = $codigo_postal;


      $alert = "success";
      $imprimir = "Datos actualizados";
    }
    if ($request->hasFile("image")) {

      $file = $request->file('image');
      $route = 'storage/images/users/';
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

      if (File::exists(storage_path() . '/app/public/' . $user->profile_photo_path)) {
        File::delete(storage_path() . '/app/public/' . $user->profile_photo_path);
      }

      $this->saveImg($file, $route, $nombreImagen);

      $routeforshow = 'images/users/';
      $user->profile_photo_path = $routeforshow . $nombreImagen;
    }


    $user->save();
    return response()->json(['message' => "Datos Personales: $imprimir, Contraseña: $imrimirPassword ", 'alert' => $alert]);
  }

  public function micuenta($section = null)
  {

    $fechahoy = Carbon::today();

    $user = Auth::user();
    $general = General::first();
    $categorias = Category::where('status', '=', 1)->where('visible', '=', 1)->get();
    $cupones = Cupon::where('status', '=', 1)->where('visible', '=', 1)->where('fecha_caducidad', '>', $fechahoy)->get();
    $cuponesUsados = HistoricoCupon::where('user_id', $user->id)->where('usado', 1)->pluck('cupones_id');
    // return view('public.dashboard', compact('user'));
    return Inertia::render('Dashboard', [
      'user' => $user,
      'section' => $section,
      'general' => $general,
      'categorias' => $categorias,
      'cupones' => $cupones,
      'cuponesUsados' => $cuponesUsados
    ])->rootView('micuenta');
  }

  public function pedidos()
  {
    $user = Auth::user();

    $detalleUsuario = UserDetails::where('email', $user->email)
      ->get()
      ->toArray();

    $ordenes = Ordenes::where('usuario_id', $detalleUsuario[0]['id'])
      ->with('DetalleOrden')
      ->with('statusOrdenes')
      ->get();

    return view('public.dashboard_order', compact('user', 'ordenes'));
  }


  public function direccionFavorita(Request $request)
  {
    $item = AddressUser::find($request->id);
    if ($item) {

      AddressUser::where('user_id', $item->user_id)->update(['favorite' => 0]);
      $item->favorite = 1;
      $item->save();

      return response()->json(['message' => 'Dirección favorita modificada']);
    }

    return response()->json(['error' => 'Item no encontrado'], 404);
  }

  public function direccion()
  {
    $user = Auth::user();
    $addresses = Address::where('user_id', $user->id)->get();
    // $addresses = Address::where('email', $user->email) ->with('price')->get();


    $departments = Price::select([
      'departments.id AS id',
      'departments.description AS description',
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->join('provinces', 'provinces.id', 'districts.province_id')
      ->join('departments', 'departments.id', 'provinces.department_id')
      ->where('departments.active', 1)
      ->groupBy('id', 'description')
      ->get();

    $provinces = Price::select([
      'provinces.id AS id',
      'provinces.description AS description',
      'provinces.department_id AS department_id'
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->join('provinces', 'provinces.id', 'districts.province_id')
      ->where('provinces.active', 1)
      ->groupBy('id', 'description', 'department_id')
      ->get();

    $districts = Price::select([
      'districts.id AS id',
      'districts.description AS description',
      'districts.province_id AS province_id',
      'prices.id AS price_id',
      'prices.price AS price'
    ])
      ->join('districts', 'districts.id', 'prices.distrito_id')
      ->where('districts.active', 1)
      ->groupBy('id', 'description', 'province_id', 'price', 'price_id')
      ->get();
    $categorias = Category::all();

    // return view('public.dashboard_direccion', compact('user', 'addresses', 'categorias', 'departments', 'provinces', 'districts'));
    return response()->json([
      'user' => $user,
      'addresses' => $addresses,
      'categorias' => $categorias,
      'departments' => $departments,
      'provinces' => $provinces,
      'districts' => $districts,
    ]);
  }

  public function obtenerProvincia($departmentId)
  {
    $provinces = DB::select('select * from provinces where active = ? and department_id = ? order by description', [1, $departmentId]);
    return response()->json($provinces);
  }

  public function obtenerDistritos($provinceId)
  {
    $distritos = DB::select('select * from districts where active = ? and province_id = ? order by description', [1, $provinceId]);
    return response()->json($distritos);
  }

  public function guardarDireccion(Request $request)
  {

    $user = Auth::user();
    $direccion = new AddressUser();

    $direccion->departamento_id = $request->departamento_id;
    $direccion->provincia_id = $request->provincia_id;
    $direccion->distrito_id = $request->distrito_id;
    $direccion->dir_av_calle = $request->nombre_calle;
    $direccion->dir_numero = $request->numero_calle;
    $direccion->dir_bloq_lote = $request->direccion;
    $direccion->user_id = $user->id;
    $direccion->save();

    return response()->json(['message' => 'Dirección guardada exitosamente']);
  }


  public function error()
  {
    //
    return view('public.404');
  }

  public function cambioGaleria(Request $request)
  {
    $colorId = $request->id;
    $productId = $request->idproduct;

    $images =  ImagenProducto::where('color_id', $colorId)->where('product_id', $productId)->get();

    // return response()->json(['images' => $images]);
    // $productos = Products::where('id', '=', $productId)->with('attributes')->with('tags')->get();
    $tallas = Combinacion::where('color_id', $colorId)->where('product_id', $productId)->with('talla')->get();

    return response()->json(
      [
        'status' => true,
        'images' => $images,
        'tallas' => $tallas
      ],
      200,
    );
  }

  public function producto(string $id)
  {
    $product = Products::where('id', '=', $id)->with('attributes')->with('tags')->first();
    // $product = Products::findOrFail($id);
    // $colors = Products::findOrFail($id)
    //           ->with('images')
    //           ->get();

    $colors = DB::table('imagen_productos')->where('product_id', $id)->groupBy('color_id')->join('attributes_values', 'color_id', 'attributes_values.id')->get();

    $productos = Products::where('id', '=', $id)->with(['attributes', 'images', 'especificaciones'])->with('tags')->first();
    $subproductos = Products::where('parent_id', '=', $id)->with(['images', 'tipos', 'especificaciones'])->get();

    $tipoDefault = Tipo::where('is_default', '=', 1)->first();

    $complementos = Products::select('products.*')
      // ->join('categories', 'categories.id', 'products.categoria_id')
      ->with('images')
      ->where('products.status', 1)
      ->where('products.tipo_servicio', 'complemento')
      ->where('products.parent_id', null)
      // ->where('categoria_id', $product->categoria_id)
      ->groupBy('products.id')
      ->get();
    foreach ($complementos as $key => $complemento) {

      $complementos[$key]['min_price'] = $complemento->min_price;
    }

    $complementosAcordion = Tag::withCount(['complements'])
      ->where('status', '=', 1)
      ->where('visible', '=', 1)
      ->having('complements_count', '>', 0) // Filtra los tags que tienen complementos
      ->get();

    // $especificaciones = Specifications::where('product_id', '=', $id)->get();
    $especificaciones = Specifications::where('product_id', '=', $id)
      ->where(function ($query) {
        $query->whereNotNull('tittle')->orWhereNotNull('specifications');
      })
      ->get();
    $productosConGalerias = DB::select(
      "
            SELECT products.*, galeries.*
            FROM products
            INNER JOIN galeries ON products.id = galeries.product_id
            WHERE products.id = :productId limit 5
        ",
      ['productId' => $id],
    );

    $IdProductosComplementarios = $productos->toArray();
    //  dump(json_decode($IdProductosComplementarios['uppsell'], true));
    $ProdComplementarios = [];

    if (!is_null($IdProductosComplementarios) && isset($IdProductosComplementarios['uppsell'])) {
      $IdProductosComplementarios = json_decode($IdProductosComplementarios['uppsell'], true);

      $ProdComplementarios = Products::whereIn('id',  $IdProductosComplementarios)->with('images')->get();
    }

    $horarios = Horarios::all();

    $atributos = Attributes::where('status', '=', true)->get();
    // $atributos = $product->attributes()->get();

    $valorAtributo = AttributesValues::where('status', '=', true)->get();

    $url_env = $_ENV['APP_URL'];
    $categorias = Category::where('is_active_campaing', 1)->get();
    $general = General::first();

    $politicasSustitucion = PoliticaSustitucion::first();
    $politicaEnvio = PolyticsCondition::first();

    // return view('public.product', compact('complementos' ,'tipoDefault', 'subproductos', 'product', 'productos', 'atributos', 'valorAtributo', 'ProdComplementarios', 'productosConGalerias', 'especificaciones', 'url_env', 'colors'));
    return Inertia::render('Product', [
      'complementos' => $complementos,
      'tipoDefault' => $tipoDefault,
      'subproductos' => $subproductos,
      'product' => $product,
      'productos' => $productos,
      'atributos' => $atributos,
      'valorAtributo' => $valorAtributo,
      'ProdComplementarios' => $ProdComplementarios,
      'productosConGalerias' => $productosConGalerias,
      'especificaciones' => $especificaciones,
      'url_env' => $url_env,
      'colors' => $colors,
      'horarios' => $horarios,
      'categorias' => $categorias,
      'general' => $general,
      'politicasSustitucion' => $politicasSustitucion,
      'politicaEnvio' => $politicaEnvio,
      'complementosAcordion' => $complementosAcordion,
      'points' => Auth::check() ? Auth::user()->points : 0
    ])->rootView('app');
  }

  public function liquidacion()
  {
    try {
      $liquidacion = Products::where('status', '=', 1)->where('visible', '=', 1)->where('liquidacion', '=', 1)->paginate(16);

      return view('public.liquidacion', compact('liquidacion'));
    } catch (\Throwable $th) {
    }
  }

  public function novedades()
  {
    try {
      $novedades = Products::where('status', '=', 1)->where('visible', '=', 1)->where('recomendar', '=', 1)->paginate(16);

      return view('public.novedades', compact('novedades'));
    } catch (\Throwable $th) {
    }
  }

  public function searchProduct(Request $request)
  {
    $query = $request->input('query');
    $resultados = Products::where('producto', 'like', "%$query%")
      ->with([
        'images' => function ($query) {
          $query->where('caratula', 1);
        }

      ])->get();

    return response()->json($resultados);
  }
  //  --------------------------------------------
  public function eliminarCuenta()
  {
    //
    $user = Auth::user();
    // Auth::logout();
    User::where('id', $user->id)->update(['ban' => 1]);
    return response()->json(['message' => 'Cuenta eliminada']);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreIndexRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Index $index)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Index $index)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateIndexRequest $request, Index $index)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Index $index)
  {
    //
  }

  /**
   * Save contact from blade
   */
  public function guardarContacto(Request $request)
  {
    $data = $request->all();
    $data['full_name'] = $request->name . ' ' . $request->last_name;

    try {
      $reglasValidacion = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      ];
      $mensajes = [
        'name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
      ];
      $request->validate($reglasValidacion, $mensajes);
      $formlanding = Message::create($data);
      $this->envioCorreo($formlanding);

      return response()->json(['message' => 'Mensaje enviado con exito']);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    }
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img = $manager->read($file);

    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }
    $img->save($route . $nombreImagen);
  }

  private function envioCorreo($data)
  {
    $name = $data['full_name'];
    $mail = EmailConfig::config();
    try {
      $mail->addAddress($data['email']);
      $mail->Body = "Hola $name su mensaje fue enviado con exito. En breve un asesor se comunicara con usted.";
      $mail->isHTML(true);
      $mail->send();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  private function envioCorreoCompra($data)
  {
    $name = $data['nombre'];
    $mail = EmailConfig::config();
    try {
      $mail->addAddress($data['email']);
      $mail->Body = "Hola $name su pedido fue realizado.";
      $mail->isHTML(true);
      $mail->send();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function procesarCarrito(Request $request)
  {
    $primeraVez = false;




    try {
      $codigoOrden = $this->codigoVentaAleatorio();
      $jsonMonto = json_decode($request->total, true);
      $montoT = $jsonMonto['total'];
      $subMonto = $jsonMonto['suma'];

      $precioEnvio = $montoT - $subMonto;
      $email = $request->email;


      $usuario = UserDetails::where('email', '=', $email)->get(); // obtenemos usuario para validarlo si no agregarlo

      //si tiene usuario registrad

      if (!$usuario->isNotEmpty()) {
        $usuario = UserDetails::create(['email' => $email]);
        $primeraVez = true;
      }

      $addres = AddressUser::create([
        'departamento_id' => (int)$request->departamento,
        'provincia_id' => (int)$request->provincia,
        'distrito_id' => (int)$request->distrito,
        'user_id' => $usuario[0]['id']
      ]);
      $this->GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $request->carrito, $addres);


      $formToken = $this->generateFormTokenIzipay($montoT, $codigoOrden, $email);

      //
      return response()->json(['mensaje' => 'Orden generada correctamente', 'formToken' => $formToken, 'codigoOrden' => $codigoOrden, 'primeraVez' => $primeraVez]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['mensaje' => "Intente de nuevo mas tarde , estamos trabajando en una solucion , $th"], 400);
    }
  }
  private function GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $carrito, $addres)
  {

    $data['codigo_orden'] = $codigoOrden;
    $data['monto'] = $montoT;
    $data['precio_envio'] = $precioEnvio;
    $data['status_id'] = '1';
    $data['usuario_id'] = $usuario[0]['id'];
    $data['address_id'] = $addres['id'];

    $orden = Ordenes::create($data);

    //creamos detalle de orden
    foreach ($carrito as $key => $value) {
      DetalleOrden::create([
        'producto_id' => $value['id'],
        'cantidad' => $value['cantidad'],
        'orden_id' => $orden->id,
        'precio' => $value['precio'],
        'talla' => $value['talla'],
        'color' => $value['color']['valor']
      ]);
    }
  }

  public function politicasDevolucion()
  {
    $politicDev = PolyticsCondition::first();
    return view('public.politicasdeenvio', compact('politicDev'));
  }

  public function TerminosyCondiciones()
  {
    $termsAndCondicitions = TermsAndCondition::first();
    return view('public.terminosycondiciones', compact('termsAndCondicitions'));
  }


  public function buscaComplementos(Request $request)
  {
    $categorias = Category::where('visible', 1)->with('productos')->get();

    return response()->json(['categorias' => $categorias]);
  }
  public function buscaSubComplementosDetalle(Request $request)
  {

    $tags = DB::select('select producto_id from tags_xproducts where tag_id = ?', [$request->id]);

    // Paso 2: Extraer los producto_id de los resultados
    $productoIds = array_map(function ($tag) {
      return $tag->producto_id;
    }, $tags);

    // Paso 3: Buscar los productos que coincidan con esos producto_id
    if (!empty($productoIds)) {
      $productos = Products::with('images')->where('tipo_servicio', 'complemento')->where('parent_id', null)->whereIn('id', $productoIds)->get();
    } else {
      $productos = [];
    }

    return response()->json(['productos' => $productos]);
  }


  public function dashboard()
  {
    try {



      return Inertia::render('Dashboard')->rootView('app');
    } catch (\Throwable $th) {
    }
  }
}
