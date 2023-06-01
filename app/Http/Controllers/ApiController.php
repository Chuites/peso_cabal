<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\baseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ParcialidadCertificada;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use View;
use DB;
use GuzzleHttp;
use PDF;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function logout(Request $request){
        Session::forget('token');
        return response()->json(200);
    }

    public function borrarSesion(Request $request){
        Session::forget('token');
        return;
    }

    public function generarPDF(Request $request, $id_parcialidad){
        $data = [
            'id_parcialidad' => $id_parcialidad
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/infoPesoParcialidad', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            $dpi_piloto = $data['dpi'];
            $nombre_piloto = $data['nombre_completo'];
            $estado_piloto = $data['justificacion'];
            $placa_transporte = $data['placa'];
            $marca_transporte = $data['marca'];
            $color_transporte = $data['color'];
            $estado_transporte = $data['justificacion2'];
            $numero_parcialidad = $data['id_parcialidad'];
            $peso_recibido = $data['peso'];
            $peso_certificado = $data['peso_certificado'];

            $parcialidadCertificada = new ParcialidadCertificada();
            $parcialidadCertificada->dpi_piloto = $dpi_piloto;
            $parcialidadCertificada->nombre_piloto = $nombre_piloto;
            $parcialidadCertificada->estado_piloto = $estado_piloto;
            $parcialidadCertificada->placa_transporte = $placa_transporte;
            $parcialidadCertificada->color_transporte = $color_transporte;
            $parcialidadCertificada->estado_transporte = $estado_transporte;
            $parcialidadCertificada->estado_transporte = $estado_transporte;
            $parcialidadCertificada->numero_parcialidad = $numero_parcialidad;
            $parcialidadCertificada->peso_recibido = $peso_recibido;
            $parcialidadCertificada->peso_certificado = $peso_certificado;
            $parcialidadCertificada->save();

            $pdf = PDF::loadView('pdf.certificado_peso', compact('dpi_piloto','nombre_piloto','estado_piloto',
            'placa_transporte','marca_transporte','color_transporte','estado_transporte','numero_parcialidad','peso_recibido','peso_certificado'));
            return $pdf->download('Certificado de Peso.pdf');
        }

    }

    public function certificarPesoParcialidad(Request $request){
        $data = [
            'id_parcialidad' => $request->id_parcialidad,
            'peso_certificado' => $request->peso_certificado
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/certificarPesoParcialidad', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return response()->json($data, 200);
        }
        else {
            $data = [
                'mensaje' => 'Error al consultar los cargamentos'
            ];
            return response()->json(401);
        }
    }


    public function listadoParcialidades(Request $request){
        $data = [
            'id_cuenta' => Session::get('id_cuenta')
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/listadoParcialidades', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. Session::get('token')
            ],
            'json' => $data
        ]);
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return response()->json($data, 200);
        }
        else {
            $data = [
                'mensaje' => 'Error al consultar los cargamentos'
            ];
            return response()->json(401);
        }
    }

    public function login(Request $request){
        $data = [
            'email' => $request->username,
            'password' => $request->password
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/login', [
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
            Session::put('id_cuenta', $data['id']);

            return response()->json(200);
        }
        else {
            return response()->json(401);
        }
    }

    public function welcome(){
        if (Session::has('token')) {
            return view('welcome');
        }else{
            return view('login/login');
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
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/confirmarTransporte', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
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
            $response = $client->post('https://beneficiodecafeapirest.herokuapp.com/api/confirmarPiloto', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('token')
                ],
                'json' => $data
            ]);
            $content = $response->getBody()->getContents();
            $estado = $response->getStatusCode();
            $data = json_decode($content, true);
            return response()->json($data);
        }
    }
}
