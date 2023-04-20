<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use Session;
use View;
use DB;
use GuzzleHttp;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function testapi(Request $request){
        $response = Http::post('http://beneficiodecafeapirest.herokuapp.com/api/testConectividad');

        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';";

        $response->header('Content-Security-Policy', $csp);

        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);

        return response()->json($data);
        /* $response = Http::post('http://beneficiodecafeapirest.herokuapp.com/api/testConectividad');

        Logger("Estado: ". $test->status());
        Logger("Consulta: ". $test->body());
        Logger("Completo: " . $test );

        return response($test->body()); */
    }

    public function crearCuenta(Request $request){
        $data = [
            'nombre' => $request->nombre,
            'dpi' => $request->dpi,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'correo' => $request->correo,
            'nit' => $request->nit
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);

        //$test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta');

        return response()->json($data);
    }
}
