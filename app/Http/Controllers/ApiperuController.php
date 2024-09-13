<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use SoDe\Extend\Fetch;
use SoDe\Extend\JSON;
use SoDe\Extend\Response;

class ApiperuController extends Controller
{
  public function get(Request $request)
  {

    $urlResponse = null;

    if (!$request->has('type') || !$request->has('number')) {
      return response()->json(['error' => 'Missing parameters'], 400);
    }
    if ($request->type == 'dni') {
      $urlResponse = "https://apiperu.dev/api/dni";
    } else {
      $urlResponse = "https://apiperu.dev/api/ruc";
    }

    $response = Response::simpleTryCatch(function ($response) use ($request, $urlResponse) {
      $res = new Fetch($urlResponse, [
        'method' => 'POST',
        'headers' => [
          'Authorization' => "Bearer" . ' ' . env('API_PERU_API_KEY')
        ],
        'body' => [
          $request->type => $request->number,
        ]
      ]);


      $data = $res->json();

      if (!$data['success']) {
        throw new Exception('No se encontraron datos');
      }

      return $data['data'];
    });

    return response($response->toArray(), $response->status);
  }
}
