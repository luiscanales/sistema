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

Route::get('/','DashboardController@index');

Route::get('/contenedores','ContenedoresController@index');

Route::get('/contenedores/nuevo','ContenedoresController@create');

Route::get('/contenedores/{ubicacion}','ContenedoresController@show');

Route::get('/incidentes','IncidentesController');

Route::get('/map','UbicacionController');

Route::get('/ruta','RutaController');