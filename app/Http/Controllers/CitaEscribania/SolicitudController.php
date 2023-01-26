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

use App\Models\CitaEscribania\Solicitud;
use App\Models\CitaEscribania\Solicitante;
use App\Models\CitaEscribania\ArchivoHistorico;
use App\Models\CitaEscribania\EscrituraPublica;
use App\Models\CitaEscribania\SeccionDeTierras;
use App\Models\CitaEscribania\Cita;
use App\Models\CitaEscribania\CatalogoItem;



class SolicitudController extends Controller
{
    private $pageData = array();
    private $ajaxResponse = array('status' => 400, 'mensaje' => '', 'data'=> array());

    public function index()
    {
        return view('citas.inicio');
    }

    public function solicitudIndex()
    {
        //Se consulta los tipos de solicitud desde el catalogo
        $catalogo =  CatalogoItem::where('id_catalogo', config('constantes.ID_C_TIPO_TRAMITE_CITA_LINEA'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item')->prepend('Seleccionar opción', '-1');
        $this->pageData['id_ci_tipo_solicitud'] = $catalogo;

        //Se consulta los horarios desde el catalogo
        $catalogo_horario = CatalogoItem::where('id_catalogo', config('constantes.ID_HORARIO_CITAS'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item')->prepend('Seleccionar opción', '-1');
        $this->pageData['id_horario_cita'] = $catalogo_horario;

        return view('citas.form_solicitud',$this->pageData);
    }

    public function getForm(request $request)
    {
        $catalogo_horario = CatalogoItem::where('id_catalogo', config('constantes.ID_HORARIO_CITAS'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item')->prepend('Seleccionar opción', '-1');
        $this->pageData['id_horario_cita'] = $catalogo_horario;

        if ($request->id_ci_tipo_solicitud == config('constantes.ID_CI_ESCRITURA_PUBLICA')) {
            $numero = 10;
            $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ 10 days"));
            $fechasDeshabilitadas = [];

            for ($i=0; $i <= 30; $i++) {
                //numero a sumar a la fecha
                $numero = $numero + 1;
                //Suma de días a la fecha a evaular
                $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ " . $numero . " days"));
                //Se formatea la fecha a evaluar
                $fecha_inicial = date_format(date_create($fecha_inicial), 'd/m/Y');

                //Consulta los horarios que ya han sido utilizados en fecha $fecha_inicial
                $consulta_horarios = Cita::select('id_horario')
                    ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
                    ->whereDate('fecha', $fecha_inicial)
                    ->where('id_tipo_solicitud', config('constantes.ID_CI_ESCRITURA_PUBLICA'))
                    ->pluck('id_horario')
                    ->toArray();
                $consulta_horarios;

                $count = count($consulta_horarios);
                //Todos los horarios han sido utilizados
                if($count >= 7){
                    //fecha se agrega a arreglo de bloqueadas
                    array_push($fechasDeshabilitadas, $fecha_inicial);
                }
            }
            //Fecha minima para crear la cita
            $this->pageData['min'] = date_format(date_create('1-'.date("m").'-'.date("Y")), 'd/m/Y');
            $this->pageData['hoy'] = date("d-m-Y",strtotime(date("d-m-Y")."+ 10 days"));

            $this->pageData['disabledDates'] = $fechasDeshabilitadas;
            $html = View::make('citas.form_solicitud_protocolo', $this->pageData);
            return Response::json(baseModel::sysResponse(200,false,['body' => $html->render()]));
        }

        elseif ($request->id_ci_tipo_solicitud == config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
        {
            $numero = 10;
            $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ 10 days"));
            $fechasDeshabilitadas = [];

            for ($i=0; $i <= 30; $i++) {
                //numero a sumar a la fecha
                $numero = $numero + 1;
                //Suma de días a la fecha a evaular
                $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ " . $numero . " days"));
                //Se formatea la fecha a evaluar
                $fecha_inicial = date_format(date_create($fecha_inicial), 'd/m/Y');

                //Consulta los horarios que ya han sido utilizados en fecha $fecha_inicial
                $consulta_horarios = Cita::select('id_horario')
                    ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
                    ->whereDate('fecha', $fecha_inicial)
                    ->where('id_tipo_solicitud', config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
                    ->pluck('id_horario')
                    ->toArray();
                $consulta_horarios;

                $count = count($consulta_horarios);

                if($count >= 7){
                    array_push($fechasDeshabilitadas, $fecha_inicial);
                }
            }

            //Fecha minima la del día corriente
            $this->pageData['min'] = date_format(date_create('1-'.date("m").'-'.date("Y")), 'd/m/Y');
            $this->pageData['hoy'] = date("d-m-Y");

            $this->pageData['disabledDates'] = $fechasDeshabilitadas;
            $html = View::make('citas.form_consulta_protocolo', $this->pageData);
            return Response::json(baseModel::sysResponse(200,false,['body' => $html->render()]));

        }

        elseif ($request->id_ci_tipo_solicitud == config('constantes.ID_CI_SECCION_DE_TIERRAS'))
        {
            $numero = 10;
            $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ 10 days"));
            $fechasDeshabilitadas = [];

            for ($i=0; $i <= 30; $i++) {
                //numero a sumar a la fecha
                $numero = $numero + 1;
                //Suma de días a la fecha a evaular
                $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ " . $numero . " days"));
                //Se formatea la fecha a evaluar
                $fecha_inicial = date_format(date_create($fecha_inicial), 'd/m/Y');

                //Consulta los horarios que ya han sido utilizados en fecha $fecha_inicial
                $consulta_horarios = Cita::select('id_horario')
                    ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
                    ->whereDate('fecha', $fecha_inicial)
                    ->where('id_tipo_solicitud', config('constantes.ID_CI_SECCION_DE_TIERRAS'))
                    ->pluck('id_horario')
                    ->toArray();
                $consulta_horarios;

                $count = count($consulta_horarios);

                if($count >= 7){
                    array_push($fechasDeshabilitadas, $fecha_inicial);
                }
            }

            //Fecha minima para crear la cita
            $this->pageData['min'] = date_format(date_create('1-'.date("m").'-'.date("Y")), 'd/m/Y');
            $this->pageData['hoy'] = date("d-m-Y",strtotime(date("d-m-Y")."+ 30 days"));

            $this->pageData['disabledDates'] = $fechasDeshabilitadas;
            $html = View::make('citas.form_solicitud_seccion_de_tierras', $this->pageData);
            return Response::json(baseModel::sysResponse(200,false,['body' => $html->render()]));
        }

        elseif ($request->id_ci_tipo_solicitud == config('constantes.ID_CI_ARCHIVO_HISTORICO'))
        {
            $numero = 10;
            $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ 10 days"));
            $fechasDeshabilitadas = [];

            for ($i=0; $i <= 30; $i++) {
                //numero a sumar a la fecha
                $numero = $numero + 1;
                //Suma de días a la fecha a evaular
                $fecha_inicial = date("d-m-Y",strtotime(date("Y-m-d")."+ " . $numero . " days"));
                //Se formatea la fecha a evaluar
                $fecha_inicial = date_format(date_create($fecha_inicial), 'd/m/Y');

                //Consulta los horarios que ya han sido utilizados en fecha $fecha_inicial
                $consulta_horarios = Cita::select('id_horario')
                    ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
                    ->whereDate('fecha', $fecha_inicial)
                    ->where('id_tipo_solicitud', config('constantes.ID_CI_ARCHIVO_HISTORICO'))
                    ->pluck('id_horario')
                    ->toArray();
                $consulta_horarios;

                $count = count($consulta_horarios);

                if($count >= 7){
                    array_push($fechasDeshabilitadas, $fecha_inicial);
                }
            }
            $this->pageData['disabledDates'] = $fechasDeshabilitadas;
            //Se consulta los tipos de solicitud desde el catalogo
            $consulta =  CatalogoItem::where('id_catalogo', config('constantes.ID_C_TIPO_CONSULTA'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item')->prepend('Seleccionar opción', '-1');
            $this->pageData['id_ci_tipo_consulta'] = $consulta;

            //Fecha minima para crear la cita
            $this->pageData['min'] = date_format(date_create('1-'.date("m").'-'.date("Y")), 'd/m/Y');
            $this->pageData['hoy'] = date("d-m-Y",strtotime(date("d-m-Y")."+ 30 days"));

            $html = View::make('citas.form_solicitud_archivo_historico', $this->pageData);
            return Response::json(baseModel::sysResponse(200,false,['body' => $html->render()]));
        }
    }

    public function horariosDisponibles(request $request)
    {
        $fecha = $request->input('fecha');
        $id_tipo_solicitud = $request->input('id_tipo_solicitud');

        //$fecha = base64_decode($fecha);

        //Verifica tipo de solicitud y acorde a esto valida disponibilidad de horarios para mostrar al usuario
        if($id_tipo_solicitud == config('constantes.ID_CI_ESCRITURA_PUBLICA'))
        {
            $horarios_utlizados = Cita::select('id_horario')
            ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
            ->whereDate('fecha', $fecha)
            ->where('id_tipo_solicitud', config('constantes.ID_CI_ESCRITURA_PUBLICA'))
            ->pluck('id_horario')
            ->toArray();
        }elseif($id_tipo_solicitud == config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
        {
            $horarios_utlizados = Cita::select('id_horario')
            ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
            ->whereDate('fecha', $fecha)
            ->where('id_tipo_solicitud', config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
            ->pluck('id_horario')
            ->toArray();
        }elseif($id_tipo_solicitud == config('constantes.ID_CI_SECCION_DE_TIERRAS'))
        {
            $horarios_utlizados = Cita::select('id_horario')
            ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
            ->whereDate('fecha', $fecha)
            ->where('id_tipo_solicitud', config('constantes.ID_CI_SECCION_DE_TIERRAS'))
            ->pluck('id_horario')
            ->toArray();
        }elseif($id_tipo_solicitud == config('constantes.ID_CI_ARCHIVO_HISTORICO'))
        {
            $horarios_utlizados = Cita::select('id_horario')
            ->join('cita_escribania.solicitud', 'solicitud.id_cita', '=', 'cita.id_cita')
            ->whereDate('fecha', $fecha)
            ->where('id_tipo_solicitud', config('constantes.ID_CI_ARCHIVO_HISTORICO'))
            ->pluck('id_horario')
            ->toArray();
        }

        $horarios_disponibles = CatalogoItem::select()
            ->where('id_catalogo', config('constantes.ID_HORARIO_CITAS'))
            ->whereNotIn('id_catalogo_item', $horarios_utlizados)
            ->pluck('catalogo_item', 'id_catalogo_item');

        $data = $horarios_disponibles;
        return Response::json($data);
    }


    public function generarSolicitud(request $req)
    {
        //Valido que la informacion del solicitante este correcta
        $validator = Validator::make($req->all(), [
            'nombres' => 'required',
            'apellidos' => 'required',
            'cui' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'lugar_notificacion' => 'required',
            'fecha_v' => 'required',
            'id_horario_cita' => 'required',
            /*'fecha_solicitud' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'numero' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'escribana_camara' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'objeto_contrato' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'new_cadena' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'',
            'observaciones' => ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SOLICITUD_PROTOCOLO'))? 'required':'', */
        ],
        [
            'nombres.required' => 'Es requerido el campo nombres',
            'apellidos.required' => 'Es requerido el campo apellidos',
            'cui.required' => 'Es requerido el campo DPI',
            'telefono.required' => 'Es requerido el campo telefono',
            'email.required' => 'Es requerido el campo Correo Electronico',
            'lugar_notificacion.required' => 'Es requerido el campo Correo Electronico',
            'fecha_v.required' => 'Es requerido el campo fecha de cita',
            'hora_v.required' => 'Es requerido el campo hora de cita',
            /*'fecha_solicitud.required' => 'Es requerido el campo fecha_solicitud',
            'numero.required' => 'Es requerido el campo numero',
            'escribana_camara.required' => 'Es requerido el campo Escribano o Camara de Gobierno',
            'objeto_contrato.required' => 'Es requerido el campo Obeto del contrato',
            'new_cadena.required' => 'Es requerido seleccionar minimo un documento a solicitar',
            'observaciones.required' => 'Es requerido seleccionar campo Observaciones', */
        ]);
        //Si algo no esta correcto se da un aviso al usuario
        if ($validator->fails()) {
            return Response::json(baseModel::sysResponse(false,'Campos requeridos. <br> - ' . implode('<br> - ', $validator->errors()->all())));
        }

        $fecha_entrega = $req->fecha_v . ' '. $req->hora_v;
        //Si todos los datos estan completos, se procede a guardar los datos del solicitante
        DB::beginTransaction();
        try {
            baseModel::usuarioModifica();
            baseModel::ipUsuario();

            $obj_plfi = new Solicitante();
            $obj_plfi = ($req->id_solicitud != '' || $req->id_solicitud != null) ? $obj_plfi->find($req->id_solicitud) : $obj_plfi;
            $obj_plfi->cui = $req->cui;
            $obj_plfi->nombre_completo = $req->nombres . " " . $req->apellidos;
            $obj_plfi->telefono = $req->telefono;
            $obj_plfi->direccion_notificacion = $req->lugar_notificacion;
            $obj_plfi->correo_electronico = $req->email;
            $obj_plfi->usuario_ingreso = $req->cui;

            if ($obj_plfi->save()) {
                DB::commit();
                //return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.',['id'=>$obj_plfi->id_solicitud]));
            }else{
                return baseModel::sysResponse(false, 'No es posible realizar la transacción, vuelva a intentarlo');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return baseModel::sysResponse(false, 'Error al guardar los datos del solicitante, comuniquese a soporte');
        }

        /////////////////////////////////////////////////////////////////////////////
        //Se realiza la validacion para saber que tipo de solicitud debe de guardar//
        /////////////////////////////////////////////////////////////////////////////

        //Transaccion para realizar el insert en la tabla archivo_historico
        if ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_ARCHIVO_HISTORICO'))
        {
            DB::beginTransaction();
            try {
                baseModel::usuarioModifica();
                baseModel::ipUsuario();
                $archivo_historico = new ArchivoHistorico();
                //$escritura_publica = ($req->id_solicitud != '' || $req->id_solicitud != null) ? $escritura_publica->find($req->id_solicitud) : $escritura_publica;
                $archivo_historico->id_tipo_consulta = $req->id_ci_tipo_consulta;
                $archivo_historico->institucion = $req->institucion;
                $archivo_historico->descripcion = $req->descripcion;
                $archivo_historico->anio = $req->anio;
                $archivo_historico->signatura = $req->signatura;
                $archivo_historico->observaciones = $req->observaciones;
                $archivo_historico->usuario_ingreso = $req->cui;

                if ($archivo_historico->save()) {
                    $this->crearCita($req);
                    $this->crearSolicitud($req);
                    DB::commit();
                    return Response::json(baseModel::sysResponse(true,'Se ha generado la solicitud correctamente.',['id'=>$archivo_historico->id_archivo_historico]));
                }else{
                    return baseModel::sysResponse(false, 'No es posible guardar los datos de Archivo Historico, vuelva a intentarlo');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return baseModel::sysResponse(false, 'Error al guardar los datos de Archivo Historico, comuniquese a soporte');
            }
        }
        //Transaccion para realizar el insert en la tabla seccion_de_tierras
        elseif ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SECCION_DE_TIERRAS'))
        {
            DB::beginTransaction();
            try {
                baseModel::usuarioModifica();
                baseModel::ipUsuario();
                $seccion_de_tierras = new SeccionDeTierras();
                //$escritura_publica = ($req->id_solicitud != '' || $req->id_solicitud != null) ? $escritura_publica->find($req->id_solicitud) : $escritura_publica;
                $seccion_de_tierras->expediente = $req->expediente;
                $seccion_de_tierras->ingeniero_medidor = $req->ing_medidor;
                $seccion_de_tierras->ingeniero_revisor = $req->ing_revisor;
                $seccion_de_tierras->finca_numero = $req->finca_numero;
                $seccion_de_tierras->diligencia_administrativa = $req->diligencia_administrativa;
                $seccion_de_tierras->opositor = $req->opositor;
                $seccion_de_tierras->terreno_denominado = $req->terreno_denominado;
                $seccion_de_tierras->jurisdiccion = $req->jurisdiccion;
                $seccion_de_tierras->departamento = $req->departamento;
                $seccion_de_tierras->usuario_ingreso = $req->cui;

                if ($seccion_de_tierras->save()) {
                    $this->crearCita($req);
                    $this->crearSolicitud($req);
                    DB::commit();
                    return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.'));
                }else{
                    return baseModel::sysResponse(false, 'No es posible guardar los datos de Seccion de Tierras, vuelva a intentarlo');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return baseModel::sysResponse(false, 'Error al guardar los datos de Seccion de Tierras, comuniquese a soporte');
            }
        }

        //Transaccion para crear la cita con la solicitud
        elseif ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
        {
            try {
                $this->crearCita($req);
                $this->crearSolicitud($req);
                return Response::json(baseModel::sysResponse(true,'Se ha generado la solicitud correctamente.'));
            } catch (Exception $e) {
                return baseModel::sysResponse(false, 'Error al guardar los datos de Consulta de Escritura Publica, comuniquese a soporte');
            }

        }

        elseif ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_ESCRITURA_PUBLICA'))
        {
            DB::beginTransaction();
            try {
                baseModel::usuarioModifica();
                baseModel::ipUsuario();
                $escritura_publica = new EscrituraPublica();
                //$escritura_publica = ($req->id_solicitud != '' || $req->id_solicitud != null) ? $escritura_publica->find($req->id_solicitud) : $escritura_publica;
                $escritura_publica->fecha = $req->fecha_solicitud;
                $escritura_publica->numero = $req->numero;
                $escritura_publica->escribano = $req->escribana_camara;
                $escritura_publica->objeto_contrato = $req->objeto_contrato;
                $escritura_publica->documentos = $req->new_cadena;
                $escritura_publica->usuario_ingreso = $req->cui;

                if ($escritura_publica->save()) {
                    DB::commit();
                    //Se crea la cita
                    $this->crearCita($req);
                    $this->crearSolicitud($req);
                    return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.',['id'=>$escritura_publica->id_escritura_publica]));
                }else{
                    return baseModel::sysResponse(false, 'No es posible guardar los datos de Archivo Historico, vuelva a intentarlo');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return baseModel::sysResponse(false, 'Error al guardar los datos de Archivo Historico, comuniquese a soporte');
            }
        }
    }

    public function crearCita($req)
    {
        DB::beginTransaction();
        try {
            baseModel::usuarioModifica();
            baseModel::ipUsuario();
            $cita = new Cita();

            //Obtengo el ultimo id_solicitante
            $last_id_solicitante = Solicitante::selectRaw('MAX(id_solicitante)')->get();
            $cita->id_horario = $req->id_horario_cita;
            $cita->id_solicitante = intval($last_id_solicitante[0]->max);
            $cita->fecha = date($req->fecha_v);
            $cita->usuario_ingreso = $req->cui;

            //logger($req->fecha_v . ' ' . gettype($req->fecha_v) . ' ' . date($req->fecha_v));

            if ($cita->save()) {
                DB::commit();
                return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.'));
            }else{
                return baseModel::sysResponse(false, 'No es posible guardar los datos de Escritura Publica, vuelva a intentarlo');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return baseModel::sysResponse(false, 'Error al guardar los datos de Escritura Publica, comuniquese a soporte');
        }
    }

    public function crearSolicitud($req)
    {
        DB::beginTransaction();
        try {
            baseModel::usuarioModifica();
            baseModel::ipUsuario();
            $solicitud = new Solicitud();
            //Obtengo el ultimo id_cita
            $last_id_cita = Cita::selectRaw('MAX(id_cita)')->get();
            $solicitud->id_cita = intval($last_id_cita[0]->max);
            $solicitud->fecha_recepcion = date("Y-m-d");
            $solicitud->usuario_ingreso = $req->cui;

            //Escritura Publica
            if ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_ESCRITURA_PUBLICA'))
            {
                $last_id_escritura_publica = EscrituraPublica::selectRaw('MAX(id_escritura_publica)')->get();
                $solicitud->id_escritura_publica = intval($last_id_escritura_publica[0]->max);
                $solicitud->id_tipo_solicitud = config('constantes.ID_CI_ESCRITURA_PUBLICA');
            }

            //Consulta Escritura Publica
            if ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
            {
                $solicitud->id_tipo_solicitud = config('constantes.ID_CI_CONSULTA_PROTOCOLO');
            }

            //Seccion de Tierras
            if ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_SECCION_DE_TIERRAS'))
            {
                $last_id_seccion_de_tierra = SeccionDeTierras::selectRaw('MAX(id_seccion_de_tierras)')->get();
                $solicitud->id_seccion_de_tierra = intval($last_id_seccion_de_tierra[0]->max);
                $solicitud->id_tipo_solicitud = config('constantes.ID_CI_SECCION_DE_TIERRAS');
            }

            //Archivo Historico
            if ($req->id_ci_tipo_solicitud == config('constantes.ID_CI_ARCHIVO_HISTORICO'))
            {
                $last_id_archivo_historico = ArchivoHistorico::selectRaw('MAX(id_archivo_historico)')->get();
                $solicitud->id_archivo_historico = intval($last_id_archivo_historico[0]->max);
                $solicitud->id_tipo_solicitud = config('constantes.ID_CI_ARCHIVO_HISTORICO');
            }

            $ultima_gestion = Solicitud::selectRaw('MAX(gestion)')->get();
            $solicitud->gestion = ( intval($ultima_gestion[0]->max) + 1 );

            //logger($intval($ultima_gestion[0]->max));
            //logger($req->fecha_v . ' ' . gettype($req->fecha_v) . ' ' . date($req->fecha_v));

            if ($solicitud->save()) {
                DB::commit();
                return Response::json(baseModel::sysResponse(true,'Transacción realizada con éxito.'));
            }else{
                return baseModel::sysResponse(false, 'No es posible guardar los datos de Escritura Publica, vuelva a intentarlo');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return baseModel::sysResponse(false, 'Error al guardar los datos de Escritura Publica, comuniquese a soporte');
        }
    }

    protected function viewBoletaPDFSolicitud(request $req)
    {
        //Envio los datos del solicitante
        $last_id_solicitante = Solicitante::selectRaw('MAX(id_solicitante)')->get();
        $id_solicitante = intval($last_id_solicitante[0]->max);
        $solicitante = Solicitante::find($id_solicitante);
        $this->pageData['solicitante'] = $solicitante;

        //Envio los datos de fecha del encabezado
        $this->pageData['dia'] = date("d");
        $this->pageData['mes'] = date("m");
        $this->pageData['anio'] = date("Y");

        //Envio los datos de la solicitud
        $last_id_solicitud = Solicitud::selectRaw('MAX(id_solicitud)')->get();
        $id_solicitud = intval($last_id_solicitud[0]->max);
        $solicitud = Solicitud::find($id_solicitud);
        $solicitud->fecha_recepcion = date('d-m-Y',(strtotime($solicitud->fecha_recepcion)));
        $this->pageData['solicitud'] = $solicitud;

        $test1 = $solicitud->id_escritura_publica;
        $test2 = $solicitud->id_archivo_historico;

        logger($test1 . ' ' . $test2);

        //Envio los datos de la cita
        $last_id_cita = Cita::selectRaw('MAX(id_cita)')->get();
        $id_cita = intval($last_id_cita[0]->max);
        $cita = Cita::find($id_cita);
        $cita->fecha = date('d-m-Y',(strtotime($cita->fecha)));
        $this->pageData['cita'] = $cita;

        if($solicitud->id_escritura_publica != null)
        {
            //Envio los datos de Escritura Publica
            $last_id_escritura_publica = EscrituraPublica::selectRaw('MAX(id_escritura_publica)')->get();
            $id_escritura_publica = intval($last_id_escritura_publica[0]->max);
            $escritura_publica = EscrituraPublica::find($id_escritura_publica);
            $this->pageData['escritura_publica'] = $escritura_publica;

            $view =  \View::make('pdfs.boleta_solicitud',$this->pageData)->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('Boleta Escritura Publica.pdf');
        }
        elseif ($solicitud->id_archivo_historico != null)
        {
            //Envio los datos de Archivo Historico
            $last_id_archivo_historico = ArchivoHistorico::selectRaw('MAX(id_archivo_historico)')->get();
            $id_archivo_historico = intval($last_id_archivo_historico[0]->max);
            $archivo_historico = ArchivoHistorico::find($id_archivo_historico);
            $this->pageData['archivo_historico'] = $archivo_historico;

            $view =  \View::make('pdfs.boleta_archivo_historico',$this->pageData)->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('Boleta Archivo Historico.pdf');
        }
        elseif ($solicitud->id_tipo_solicitud == config('constantes.ID_CI_CONSULTA_PROTOCOLO'))
        {
            //Se envian los datos al PDF de Consulta Escritura Publica
            $view =  \View::make('pdfs.boleta_consulta_escritura_publica',$this->pageData)->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            $pdf->setPaper(array(0,0,419.53,595.28), 'landscape');
            return $pdf->stream('Boleta Cita Escritura Publica.pdf');
        }
        elseif ($solicitud->id_seccion_de_tierra != null)
        {
            //Envio los datos de Seccion de Tierras
            $last_id_seccion_de_tierras = SeccionDeTierras::selectRaw('MAX(id_seccion_de_tierras)')->get();
            $id_seccion_de_tierras = intval($last_id_seccion_de_tierras[0]->max);
            $seccion_de_tierras = SeccionDeTierras::find($id_seccion_de_tierras);
            $this->pageData['seccion_de_tierras'] = $seccion_de_tierras;

            $view =  \View::make('pdfs.boleta_seccion_de_tierras',$this->pageData)->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('Boleta Seccion de Tierras.pdf');
        }

    }

}
