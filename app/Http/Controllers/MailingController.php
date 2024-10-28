<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Models\Horarios;
use App\Models\Ordenes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use SoDe\Extend\File;
use SoDe\Extend\JSON;
use SoDe\Extend\Text;

class MailingController extends Controller
{
    static function notifyPoints(User $userJpa, Ordenes $ordenJpa, Horarios $horarioJpa, $generals)
    {
        try {
            $productos = MailingController::obtenerProductos($ordenJpa);

            // $content = File::get('../storage/app/utils/mailing/pagoTc.html');
            $data =  [
                'client' => $userJpa,
                'sale' => $ordenJpa,
                'domain' => env('APP_DOMAIN'),
                'horario' => $horarioJpa,
                'generals' => $generals,
                'productos' => $productos
            ];
            $content = View::make('mailing.pagoTc', $data)->render();

            $mail = EmailConfig::config();
            $mail->Subject = 'Compra Procesada ';
            $mail->isHTML(true);
            $mail->Body = $content;

            // $mail->Body = Text::replaceData($content, JSON::flatten($data), [
            //     'client.name' => fn($x) => explode(' ', $x)[0]
            // ]);
            $mail->addAddress($userJpa->email, $userJpa->name);
            $mail->send();
        } catch (\Throwable $th) {
            dump($th);
        }
    }
    static function notifyTransfer(User $userJpa, Ordenes $ordenJpa, Horarios $horarioJpa, $generals)
    {

        try {
            $productos = MailingController::obtenerProductos($ordenJpa);
            // $content = File::get('../storage/app/utils/mailing/transfer.html');
            $data =  [
                'client' => $userJpa,
                'sale' => $ordenJpa,
                'domain' => env('APP_DOMAIN'),
                'horario' => $horarioJpa,
                'generals' => $generals,
                'productos' => $productos
            ];
            $content = View::make('mailing.transfer', $data)->render();
            $mail = EmailConfig::config();
            $mail->Subject = 'Su compra ha sido procesada, en breve validaremos su transferencia  ';
            $mail->isHTML(true);
            $mail->Body = $content;
            // $mail->Body = Text::replaceData($content, JSON::flatten($data), [
            // 'client.name' => fn($x) => explode(' ', $x)[0]
            // ]);
            $mail->addAddress($userJpa->email, $userJpa->name);
            $mail->send();
        } catch (\Throwable $th) {
            dump($th);
        }
    }
    static function ventaProces(User $userJpa, Ordenes $ordenJpa)
    {
        try {
            $content = File::get('../storage/app/utils/mailing/points.html');
            $data =  [
                'client' => $userJpa->toArray(),
                'sale' => $ordenJpa->toArray(),
                'domain' => env('APP_DOMAIN')
            ];
            $mail = EmailConfig::config();
            $mail->Subject = 'Su pago ha sido verificado, su compra se procesara en unos minutos';
            $mail->isHTML(true);
            $mail->Body = Text::replaceData($content, JSON::flatten($data), [
                'client.name' => fn($x) => explode(' ', $x)[0]
            ]);
            $mail->addAddress($userJpa->email, $userJpa->name);
            $mail->send();
        } catch (\Throwable $th) {
        }
    }

    static function obtenerProductos($sale)
    {

        $ordenes = Ordenes::find($sale->id);
        return $ordenes->DetalleOrden;
    }
}
