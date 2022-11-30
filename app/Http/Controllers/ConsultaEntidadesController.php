<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use View;
use DB;
use Validator;

class ConsultaEntidadesController extends Controller
{
    private $pageData = array(); 
    private $ajaxResponse = array('status' => 400,'mensaje' => '', 'data' => array() );

    
    public function consultaEntidadesIndex()
    {
        return view('consulta_entidades');
    }

    public function viewEntidades(request $request)
    {
        $validator = Validator::make($request->all(), [
                'entidad' => 'required|min:3',
                'g-recaptcha-response' => 'required',
            ],
            [   
                'entidad.required'=>'Ingrese un nombre de entidad',
                'entidad.min'=>'Amplié  el nombre de entidad',
                'g-recaptcha-response.required'=>'El reCAPTCHA es requerido'
            ]);
        if ($validator->fails()) {
            $this->ajaxResponse['status'] = 400;
             $this->ajaxResponse['mensaje'] = 'Debe completar los campos requeridos. <br> - ' . implode('<br> - ', $validator->errors()->all());
            return Response::json($this->ajaxResponse);
        }
        
        $this->ajaxResponse['status'] = 200;
        $this->ajaxResponse['tabla'] = View::make('tabla',$this->pageData)->render();
        return Response::json($this->ajaxResponse);
    }

    public function listarNombresEntidades(request $request){
        
        $dataTablesResponse['draw'] = intval($request->draw);
        //obtengo datos de paginacion
        $limit = ($request->length != '') ? $request->length : false;
        $offset = $request->start; //next tabla
        $order = $request->order;
        //limit
        if (!$limit) {
            $limit = 20;
        }
        //offeset
        if (!$offset){
            $offset = 0;
        }
        $columns = array(  
          'r_nombre_entidad',
          'r_nombre_entidad'
        );
        $entidad = trim($request->entidad);
        $entidad = str_replace('\'', '\'\'', $entidad);
        if($entidad == null || $entidad ==''){
            return Response::json(baseModel::sysResponse(false,'Ingrese una entidad'));
        }
        $sql = "SELECT * from repeju.fn_consulta_publica_entidad("."'$entidad'".")";
                
        $fn_migracion =  DB::table(DB::raw("($sql) as u"));

        $total = $fn_migracion->count();

        /*if($total > 1000){
            return Response::json(baseModel::sysResponse(false,'Las coincidencias superan el limite registros a mostrar, amplié el nombre de la entidad. '));
        }*/

        //ordenamiento
        if ($order){
            if (is_array($order) && array_key_exists($order[0]['column'], $columns)) {
                $fn_migracion = $fn_migracion->orderBy($columns[$order[0]['column']],$order[0]['dir']);
            }
            $fn_migracion =  $fn_migracion->skip($offset)->take($limit);
        } else {
            $fn_migracion = $fn_migracion->orderBy('r_nombre_entidad','ASC');
        }
        $Migra = $fn_migracion->get();
        if(count($Migra) != 0){
            $fila = 1;
            if($offset != 0)
                $fila = $offset+1;
            foreach ($Migra as $migracion) {
                $results[] = array(
                  $fila,
                  $migracion->r_nombre_entidad
                );
            $fila++;
            }
        }else{
            $results = array();
        }
        $dataTablesResponse['recordsTotal'] = $total;
        $dataTablesResponse['recordsFiltered'] = $total;
        $dataTablesResponse['data'] = $results;
        echo json_encode($dataTablesResponse);
        exit();
    }
}
