<?php

namespace App\Http\Controllers\CitaEscribania;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use DB;
use View;
use Validate;
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
        $catalogo =  T3CatalogoItem::where('id_catalogo', config('constantes.ID_C_TIPO_TRAMITE_CITA_LINEA'))->where('esta_activo', true)->pluck('catalogo_item', 'id_catalogo_item');
        $this->pageData['id_ci_tipo_solicitud'] = $catalogo;
        return view('citas.form_solicitud',$this->pageData);
    }

}
