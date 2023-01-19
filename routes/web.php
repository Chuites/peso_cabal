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

Route::get('/', 'CitaEscribania\SolicitudController@index')->name('index');
Route::get('solicitud', 'CitaEscribania\SolicitudController@solicitudIndex')->name('solicitudIndex');
Route::post('solicitud/getform', 'CitaEscribania\SolicitudController@getForm')->name('getForm');
Route::post('solicitud/generarSolicitud', 'CitaEscribania\SolicitudController@generarSolicitud')->name('generarSolicitud');
Route::post('solicitud/viewBoletaPDFSolicitud', 'CitaEscribania\SolicitudController@viewBoletaPDFSolicitud')->name('viewBoletaPDFSolicitud');



Route::post('consulta','ConsultaEntidadesController@viewEntidades')->name('viewEntidades');
Route::post('consulta/lista','ConsultaEntidadesController@listarNombresEntidades')->name('listarNombresEntidades');






