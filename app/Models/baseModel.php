<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Rol;
use DB;
use Session;
use Request;
use Validator;

class baseModel extends Model
{
    
    /**
     * [usuarioModifica coloca el usuario que ha modificado o insertado en la BD]
     * @autor rgiron 14-06-2016
     */
    static function usuarioModifica()
    {
        DB::select( DB::raw("SELECT public.set_var ('usuario','".Session::get('username')."')") );
    }

    /**
     * [usuarioModifica coloca la ip que ha modificado o insertado en la BD]
     * @autor rgiron 14-06-2016
     */
    static function ipUsuario()
    {
        DB::select( DB::raw("SELECT public.set_var ('ip','".Request::ip()."')") );
    }
    /**
     * Metodo para manejar mensajes de respuesta
     * @param  integer $status  [true or false if success or error]
     * @param  string  $message [message]
     * @param  array   $data    [data for response]
     * @param  array   $errors  [data if was error]
     * @return [type]           [response]
     * @autor Carlos Corzantes [carlos.corzantes@gmail.com]
     */    
	static function sysResponse($status = 400, $message = '', $data = [], $errors = [])
    {
        if ($status === false || $status == '') {
            $status = 400;
        } else if ($status === true) {
            $status = 200;
        }
        
        $message = ($message === false || $message == '')? '' : $message;
        $data = ($data === false || $data == '')? [] : $data;
        $errors = ($errors === false || $errors == '')? [] : $errors;

        $sysResponse = new \stdClass();
        $sysResponse->status = $status;
        $sysResponse->mensaje = $message;
        $sysResponse->data = $data;
        $sysResponse->responseJSON = $errors;        
        return $sysResponse;
    }
    /**
 * [quita_tildes: Quita las tildes de las vocales]
 * @param  [string] $s [Texto enviado]
 * @return [string] $s [Texto sin tildes en las vocales]
 */
    static function quitarTildes($string) {      
        //Reemplazamos caracteres especiales latinos
        $find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç');
        $repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c');
        $string = str_replace($find, $repl, $string);
        //Reemplazamos tildes
        $find = array('á','é','í','ó','ú', 'Á','É','Í','Ó','Ú');
        $repl = array('a','e','i','o','u', 'A','E','I','O','U');
        $string = str_replace($find, $repl, $string); 
        return $string;        
    }

    static function getLetrasyNumeros($texto = '') 
    {
        $instancia = new static;

        if ($texto == '') {
            return $texto;        
        }

        //quito tildes
        $newText = $instancia->quitarTildes($texto);
        //elimino caracteres
        $newText = preg_replace("[^A-Za-z0-9]", "", $newText);
        return $newText;
    }

    static function dbDate($fecha = '', $formatoIngles = true, $simbolo = '-') 
    {        
        if ($fecha == '') {
            return null;
        }

        $fecha = str_replace('/', '-', $fecha);

        $v = Validator::make(['fecha' => $fecha], ['fecha' => 'date']);

        if ($v->fails()) {            
            return null;
        } else {
            if ($formatoIngles) {
                $fecha = date_format(date_create($fecha),'Y-m-d'); 
            } else {
                $fecha = date_format(date_create($fecha),'d-m-Y');
            }

            if ($simbolo != '-') {
                $fecha = str_replace('-', '/', $fecha);
            }
            return $fecha;
        }
    }
    public static function cambiaMayuscula($texto = null)
    {
        if (is_null($texto)) {
            return '';
        }

        $replace = str_replace('ñ', 'Ñ', $texto);
        $replace = str_replace('á', 'Á', $replace);
        $replace = str_replace('é', 'É', $replace);
        $replace = str_replace('í', 'Í', $replace);
        $replace = str_replace('ó', 'Ó', $replace);
        $replace = str_replace('ú', 'Ú', $replace);

        return strtoupper($replace);
    }

    /**
     * getFormatoDPI
     * convierte string de documento de identifiacion a su formato ingresado 
     *
     * @param [type] $documentoIdentidicacion
     * @return void
     */
    static function getFormatoDocumentoIdentificacion($documentoIdentidicacion, $cantidadDigitos, $formato)
    {   
        if ($documentoIdentidicacion == '') {
            return $documentoIdentidicacion;
        }

        $arrTexto = str_split($documentoIdentidicacion);

        if (count($arrTexto) != $cantidadDigitos) {
            return $documentoIdentidicacion;
        }
        
        $texto    = '';
        $iInicio  = 0;
        $iFin     = 0;
        $arrFormato  = explode(',', $formato);
        foreach ($arrFormato as $item) {
            $iFin += $item;
            for ($i=$iInicio; $i < $iFin; $i++) { 
                $texto .= $arrTexto[$i];
            } 
            $texto .= ' ';
            $iInicio = $iFin;
        }
        return $texto;
    }

    public static function isRol($userID, $rol = 0){
        $roles = Rol::whereHas('moduloRol',function($q) use ($userID){
            $q->whereHas('usuarioModuloRol',function($sq) use ($userID){
                $sq->where('id_usuario',$userID);
                $sq->where('esta_activo',true);
            });
        });

        if($rol)
            return $roles->where('id_rol',$rol)->count();

        return $roles->get();
    }
}
