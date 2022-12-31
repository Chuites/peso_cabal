<?php

namespace App\Http\Controllers\CitaEscribania;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use DB;
use View;
use Validator;
use PDF;

use App\Models\baseModel;


use App\Models\CitaEscribania\T1Solicitud;
use App\Models\CitaEscribania\T3CatalogoItem;



class T1SolicitudController extends Controller
{
    private $pageData = array();
    private $ajaxResponse = array('status' => 400, 'mensaje' => '', 'data'=> array());

    public function index()
    {
        return view('citas.inicio');
    }

    public function solicitudIndex()
    {
        $catalogo =  T3CatalogoItem::where('id_catalogo', config('constantes.ID_C_TIPO_TRAMITE_CITA_LINEA'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item')->prepend('Seleccionar opción', '-1');
        $this->pageData['id_ci_tipo_solicitud'] = $catalogo;
        return view('citas.form_solicitud',$this->pageData);
    }

    public function getForm(request $request){
        $this->pageData['min'] = date_format(date_create('1-'.date("m").'-'.date("Y")), 'd/m/Y');
        
       // $date = date_format(date_create(date('Y-m-d')), 'd/m/Y');
        //$this->pageData['hoy'] = strtotime($date."+ 2 days");

        //$date = date("d-m-Y");
        //$mod_date = strtotime(date("d-m-Y")."+ 10 days");
        //$aa =  date("d-m-Y",strtotime(date("d-m-Y")."+ 10 days"));
        $this->pageData['hoy'] = date("d-m-Y",strtotime(date("d-m-Y")."+ 10 days"));
        //$this->pageData['hoy'] = date_format(date_create(  ), 'd/m/Y');
        
       
        $html = View::make('citas.form_solicitud_protocolo', $this->pageData);
        return Response::json(baseModel::sysResponse(200,false,['body' => $html->render()]));
    }

    public function generarSolicitud(request $req){
        //dd($req->all());
        $validator = Validator::make($req->all(), [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cui' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'lugar_notificacion' => 'required',
            'fecha_v' => 'required',
            'hora_v' => 'required', 

            'fecha_solicitud' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'numero' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'escribana_camara' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'objeto_contrato' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'new_cadena' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'observaciones' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            
/*            
            
            'id_privado_libertad' => 'required|not_in:-1',
            'id_usuario' => 'required|not_in:-1',
            'detalle_actualizacion' => 'required',
            'numero_autorizacion_admin' => 'required',
            'fecha_del' => 'required',
            'fecha_al' => 'required',
            'tiempo1' => 'required',
            'tiempo2' => 'required',
            'numero_autorizacion' => 'required',*/

        ],[
           'nombres.required' => 'Es requerido el campo nombres',
           'apellidos.required' => 'Es requerido el campo apellidos',
           'cui.required' => 'Es requerido el campo DPI',
           'telefono.required' => 'Es requerido el campo telefono',
           'email.required' => 'Es requerido el campo Correo Electronico',
           'lugar_notificacion.required' => 'Es requerido el campo Correo Electronico',
           'fecha_v.required' => 'Es requerido el campo fecha de cita',
           'hora_v.required' => 'Es requerido el campo hora de cita',

           'fecha_solicitud.required' => 'Es requerido el campo fecha_solicitud',
           'numero.required' => 'Es requerido el campo numero',
           'escribana_camara.required' => 'Es requerido el campo Escribano o Camara de Gobierno',
           'objeto_contrato.required' => 'Es requerido el campo Obeto del contrato',
           'new_cadena.required' => 'Es requerido seleccionar minimo un documento a solicitar',
           'observaciones.required' => 'Es requerido seleccionar campo Observaciones',

           
          
/*
           'id_privado_libertad.required' => 'Elija una Privado(a) de Libertad',
           'id_privado_libertad.not_in' => 'Elija una Privado(a) de Libertad',
           'id_usuario.required' => 'Elija una Usuario',
           'id_usuario.not_in' => 'Elija una Usuario',
           'detalle_actualizacion.required' => 'Es requerido el detalle de la actualizacion',
           'numero_autorizacion_admin.required' => 'Es requerido el numero de la autorizacion admin',
           
           'fecha_del.required' => 'Es requerido el campo fecha del',
           'fecha_al.required' => 'Es requerido el campo fecha al',
           'tiempo1.required' => 'Es requerido el campo hora del',
           'tiempo2.required' => 'Es requerido el campo hora al',
           'numero_autorizacion.required' => 'Es requerida la generacion de numero de autorizacion',*/
        ]);

        if ($validator->fails()) {
            return Response::json(baseModel::sysResponse(false,'Campos requeridos. <br> - ' . implode('<br> - ', $validator->errors()->all())));
        }
        $fecha_entrega = $req->fecha_v . ' '. $req->hora_v;

       DB::beginTransaction();
        try {
            baseModel::usuarioModifica();
            baseModel::ipUsuario();
            $obj_plfi = new T1Solicitud();
            $obj_plfi = ($req->id_solicitud != '' || $req->id_solicitud != null) ? $obj_plfi->find($req->id_solicitud) : $obj_plfi;
            $obj_plfi->nombres = $req->nombres;
            $obj_plfi->apellidos = $req->apellidos;
            $obj_plfi->cui = $req->cui;
            $obj_plfi->telefono = $req->telefono;
            $obj_plfi->lugar_notificacion = $req->lugar_notificacion;
            $obj_plfi->id_ci_tipo_solicitud = $req->id_ci_tipo_solicitud;
            $obj_plfi->email = $req->email;
            $obj_plfi->fecha_solicitud = $req->fecha_solicitud;
            $obj_plfi->numero = $req->numero;
            $obj_plfi->escribana_camara = $req->escribana_camara;
            $obj_plfi->objeto_contrato = $req->objeto_contrato;
            $obj_plfi->documentos = $req->new_cadena;
            $obj_plfi->observaciones = $req->observaciones;
            $obj_plfi->fecha_entrega = $fecha_entrega;

            if ($obj_plfi->save()) {
                DB::commit();
                return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.',['id'=>$obj_plfi->id_solicitud]));
            }else{
                return baseModel::sysResponse(false, 'No es posible realizar la transacción, vuelva a intentarlo');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return baseModel::sysResponse(false, 'Error al guardar, comuniquese a soporte');
        }
    }

    public function viewBoletaPDFSolicitud(request $req)
    {
        $obj = T1Solicitud::find($req->id);
        //dd($obj);
        $this->pageData['data'] = $obj;
        $this->pageDate['fh_entrega'] = date("d/m/Y", strtotime($obj->fecha_entrega)); 
        $view =  \View::make('pdfs.boleta_solicitud',$this->pageData)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('imp_boleta');
    }

    

}
