<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Models\Ordenes;
use App\Models\User;
use Illuminate\Http\Request;
use SoDe\Extend\File;
use SoDe\Extend\JSON;
use SoDe\Extend\Text;

class MailingController extends Controller
{
    static function notifyPoints (User $userJpa, Ordenes $ordenJpa) {
        try {
            $content = File::get('../storage/app/utils/mailing/points.html');
            $data=  [
                'client' => $userJpa->toArray(),
                'sale' => $ordenJpa->toArray(),
                'domain' => env('APP_DOMAIN')
            ];
            $mail = EmailConfig::config();
            $mail->Subject = 'Has acumulado ' . $ordenJpa->points . ' puntos';
            $mail->isHTML(true);
            $mail->Body = Text::replaceData($content, JSON::flatten($data));
            $mail->addAddress($userJpa->email, $userJpa->name);
            $mail->send();
        } catch (\Throwable $th) {
            // dump($th->getMessage());
        }
    }
}
