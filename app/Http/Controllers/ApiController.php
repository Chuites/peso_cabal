<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function logout(Request $request){
        //$response = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/testConectividad');
        Session::forget('token');
        return response()->json(200);
    }

    public function borrarSesion(Request $request){
        //$response = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/testConectividad');
        Session::forget('token');
        return;
    }

    public function testapi(Request $request){
        //$response = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/testConectividad');
        $response = Http::post('http://127.0.0.1:8081/api/testConectividad');
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self';";
        $response->header('Content-Security-Policy', $csp);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        return response()->json($data);
    }

    public function login(Request $request){
        $data = [
            'email' => $request->username,
            'password' => $request->password
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://127.0.0.1:8081/api/login', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            Session::put('token', $data['token']);

            return response()->json(['success' => 'Credenciales correctas'], 200);
        }
        else {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    }

    public function welcome(){
        if (Session::has('token')) {
            return \view('welcome');
        }else{
            return \view('login/login');
        }

    }

    public function testTransporte(Request $request){
        $validator = Validator::make($request->all(), [
            'placa' => 'required|regex:/^[A-Z]{1}\d{3}[A-Z]{3}$/',
        ],
        [
            //Mensajes a mostrar
            'placa.required' => 'Es requerida la placa',
            'placa.regex' => 'Debe ingresar un formato de placa valido'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'placa' => $request->placa
            ];
            $client = new \GuzzleHttp\Client();
            //$test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta');
            $response = $client->post('http://127.0.0.1:8081/api/confirmarTransporte', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $estado = $response->getStatusCode();
            $data = json_decode($content, true);

            return response()->json($data);
        }
    }

    public function testPiloto(Request $request){
        $validator = Validator::make($request->all(), [
            'dpi_piloto' => 'required|numeric|digits:13',
        ],
        [
            //Mensajes a mostrar
            'dpi_piloto.required' => 'Es requerida un numero de DPI',
            'dpi_piloto.digits' => 'El DPI debe contener 13 digitos'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'dpi' => $request->dpi_piloto
            ];
            $client = new \GuzzleHttp\Client();
            //$test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta');
            $response = $client->post('http://127.0.0.1:8081/api/confirmarPiloto', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $estado = $response->getStatusCode();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }

    public function crearCuenta(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric|digits:8',
            'dpi' => 'required|numeric|digits:13',
            'nit' => 'required|numeric|digits:8',
            'correo' => 'required|email'
        ],
        [
            //Mensajes a mostrar
            'nombre.required' => 'Es requerida la informacion de nombre',
            'direccion.required' => 'Es requerida la informacion de direccion',
            'telefono.required' => 'Es requerida la informacion de telefono',
            'telefono.digits' => 'El telefono debe tener 8 digitos',
            'dpi.required' => 'Es requerida la informacion de dpi',
            'dpi.digits' => 'El DPI debe contener 13 digitos',
            'nit.required' => 'Es requerida la informacion de nit',
            'nit.digits' => 'El nit debe tener 8 digitos',
            'correo.required' => 'Es requerida la direccion de correo',
            'correo.email' => 'Formato de correo no valido',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'nombre' => $request->nombre,
                'dpi' => $request->dpi,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'correo' => $request->correo,
                'nit' => $request->nit
            ];
            $client = new \GuzzleHttp\Client();
            //$test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta');
            $response = $client->post('http://127.0.0.1:8081/api/crearCuenta', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }

    public function enviarCargamento(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|numeric|digits:8',
            'dpi' => 'required|numeric|digits:13',
            'nit' => 'required|numeric|digits:8',
            'correo' => 'required|email'
        ],
        [
            //Mensajes a mostrar
            'nombre.required' => 'Es requerida la informacion de nombre',
            'direccion.required' => 'Es requerida la informacion de direccion',
            'telefono.required' => 'Es requerida la informacion de telefono',
            'telefono.digits' => 'El telefono debe tener 8 digitos',
            'dpi.required' => 'Es requerida la informacion de dpi',
            'dpi.digits' => 'El DPI debe contener 13 digitos',
            'nit.required' => 'Es requerida la informacion de nit',
            'nit.digits' => 'El nit debe tener 8 digitos',
            'correo.required' => 'Es requerida la direccion de correo',
            'correo.email' => 'Formato de correo no valido',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());
        }else{
            $data = [
                'nombre' => $request->nombre,
                'dpi' => $request->dpi,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'correo' => $request->correo,
                'nit' => $request->nit
            ];
            $client = new \GuzzleHttp\Client();
            //$test = Http::post('https://beneficiodecafeapirest.herokuapp.com/api/crearCuenta');
            $response = $client->post('http://127.0.0.1:8081/api/crearCuenta', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }
}
