<?php

namespace App\Http\Controllers\citas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use View;
use DB;
use Validator;

class citasController extends Controller
{
    private $pageData = array(); 
    private $ajaxResponse = array('status' => 400,'mensaje' => '', 'data' => array() );

    public function index()
    {
        return view('citas.inicio');
    }

    
    public function solicitud()
    {
        return view('citas.form_solicitud');
    }
}
