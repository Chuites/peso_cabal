<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'CitaEscribania\T1SolicitudController@index')->name('index');
Route::get('solicitud', 'CitaEscribania\T1SolicitudController@solicitudIndex')->name('solicitudIndex');

Route::post('consulta','ConsultaEntidadesController@viewEntidades')->name('viewEntidades');
Route::post('consulta/lista','ConsultaEntidadesController@listarNombresEntidades')->name('listarNombresEntidades');






