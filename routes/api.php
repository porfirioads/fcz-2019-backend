<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('categorias/lista', 'CategoriaController@getListaCategorias');
Route::get('eventos/lista', 'EventoController@getListaEventos');
Route::post('eventos/calificar', 'EventoController@calificarEvento');
Route::get('sedes/detalle', 'SedeController@getDetalleSede');
