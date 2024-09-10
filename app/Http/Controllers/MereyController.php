<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use SoDe\Extend\Fetch;
use SoDe\Extend\JSON;
use SoDe\Extend\Response;

class MereyController extends Controller
{
    public function get(Request $request)
    {
        $response = Response::simpleTryCatch(function ($response) use ($request) {
            $res = new Fetch('https://merey.pe/consulta', [
                'method' => 'POST',
                'body' => [
                    'funcion' => 'consultarDocumento',
                    'tipoDoc' => $request->type,
                    'numero' => $request->number,
                    'token' => env('MEREY_APIKEY')
                ]
            ]);
            $data = JSON::parseable($res->text());
            if (!$data) throw new Exception('No se encontraron datos');

            if ($request->type == 'ruc') {
                if ($data['razonSocial'] == null) throw new Exception('No se encontraron datos de la empresa');
                return [
                    'name' => $data['razonSocial'],
                    'address' => $data['direccion']
                ];
            } else {
                if ($data['nombre'] == null) throw new Exception('No se encontraron datos de la persona');
                return [
                    'name' => $data['nombre'],
                    'address' => null
                ];
            }
        });
        return response($response->toArray(), $response->status);
    }
}
