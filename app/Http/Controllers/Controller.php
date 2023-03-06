<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function testapi(Request $request){
        $test = Http::dd()->post('https://beneficiodecafeapirest.herokuapp.com/categorias');
        $msg = "This is a simple message.";

        return response()->json(['test' => $msg]);
    }
}
