<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckApiToken;

Route::get('/', function () {
    return view('./login/login');
});
Route::post('login', 'App\Http\Controllers\ApiController@login')->name("login");

/* Route::middleware([CheckApiToken::class])->group(function () {
    Route::get('welcome', 'App\Http\Controllers\ApiController@welcome')->name("welcome");
    Route::post('TestApi', 'App\Http\Controllers\ApiController@testapi')->name("TestApi");
    Route::post('crearCuenta', 'App\Http\Controllers\ApiController@crearCuenta')->name("crearCuenta");
    Route::post('testTransporte', 'App\Http\Controllers\ApiController@testTransporte')->name("testTransporte");
    Route::post('testPiloto', 'App\Http\Controllers\ApiController@testPiloto')->name("testPiloto");
    Route::post('enviarCargamento', 'App\Http\Controllers\ApiController@enviarCargamento')->name("enviarCargamento");
}); */
Route::get('welcome', 'App\Http\Controllers\ApiController@welcome')->name("welcome");
Route::post('TestApi', 'App\Http\Controllers\ApiController@testapi')->name("TestApi");
Route::post('logout', 'App\Http\Controllers\ApiController@logout')->name("logout");
Route::post('borrarSesion', 'App\Http\Controllers\ApiController@borrarSesion')->name("borrarSesion");
Route::post('crearCuenta', 'App\Http\Controllers\ApiController@crearCuenta')->name("crearCuenta");
Route::post('testTransporte', 'App\Http\Controllers\ApiController@testTransporte')->name("testTransporte");
Route::post('testPiloto', 'App\Http\Controllers\ApiController@testPiloto')->name("testPiloto");
Route::post('enviarCargamento', 'App\Http\Controllers\ApiController@enviarCargamento')->name("enviarCargamento");
Route::post('listadoCargamentos', 'App\Http\Controllers\ApiController@listadoCargamentos')->name("listadoCargamentos");
Route::post('enviarParcialidad', 'App\Http\Controllers\ApiController@enviarParcialidad')->name("enviarParcialidad");
Route::post('listadoParcialidades', 'App\Http\Controllers\ApiController@listadoParcialidades')->name("listadoParcialidades");
Route::post('certificarPesoParcialidad', 'App\Http\Controllers\ApiController@certificarPesoParcialidad')->name("certificarPesoParcialidad");
Route::get('generarPDF\{id_parcialidad?}', 'App\Http\Controllers\ApiController@generarPDF')->name("generarPDF");
