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

Route::get('/','SigninController');

Route::get('/usuarios','UserController@index');

Route::get('/usuarios/{id}', 'UserController@show')->where('id','\d+');

Route::get('/usuarios/nuevo','UserController@create');

Route::get('/saludo/{name}/{nickname?}','WelcomeUserController');

Route::get('/contenedores','ContenedoresController@index');

Route::get('/contenedores/nuevo','ContenedoresController@create');

Route::get('/contenedores/{ubicacion}','ContenedoresController@show');

Route::get('/dashboard','DashboardController');

Route::get('/reportes','ReportesController');

Route::get('/incidentes','IncidentesController');

Route::get('/contacto','ContactoController');