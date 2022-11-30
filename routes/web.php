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

Route::get('/', 'citas\citasController@index')->name('index');
Route::get('solicitud', 'citas\citasController@solicitud')->name('solicitud');
Route::post('consulta','ConsultaEntidadesController@viewEntidades')->name('viewEntidades');
Route::post('consulta/lista','ConsultaEntidadesController@listarNombresEntidades')->name('listarNombresEntidades');





