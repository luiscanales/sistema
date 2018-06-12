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

Route::get('/map',function(){
    $config['center'] = 'Toesca, Chile';
    $config['zoom'] = '15';
    $config['map_height'] = '500px';
    $config['scrollwheel'] = false;

    GMaps::initialize($config);

    $marker['position'] = 'Santiago 1390, Santiago';
    $marker['infowindow_content'] = 'Santiago 1390';
    $marker['icon'] = 'http://maps.google.com/mapfiles/ms/micons/truck.png';
    GMaps::add_marker($marker);
    
    $marker['position'] = 'Vergara 432, Santiago';
    $marker['infowindow_content'] = 'Vergara 432';
    $marker['icon'] = 'http://maps.google.com/mapfiles/ms/micons/recycle.png';
    GMaps::add_marker($marker);
    
    $marker['position'] = 'Grajales 2395, Santiago';
    $marker['infowindow_content'] = 'Grajales 2395';
    GMaps::add_marker($marker);
    
    $marker['position'] = 'Nataniel Cox 153, Santiago';
    $marker['infowindow_content'] = 'Nataniel Cox 153';
    GMaps::add_marker($marker);
    
    $map = GMaps::create_map();
    return view('contacto')->with('map',$map);
});