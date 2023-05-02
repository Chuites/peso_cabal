<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('TestApi', 'App\Http\Controllers\ApiController@testapi')->name("TestApi");
Route::post('crearCuenta', 'App\Http\Controllers\ApiController@crearCuenta')->name("crearCuenta");
Route::post('testTransporte', 'App\Http\Controllers\ApiController@testTransporte')->name("testTransporte");
Route::post('testPiloto', 'App\Http\Controllers\ApiController@testPiloto')->name("testPiloto");
Route::post('enviarCargamento', 'App\Http\Controllers\ApiController@enviarCargamento')->name("enviarCargamento");

