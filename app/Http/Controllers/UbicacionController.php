<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;

class UbicacionController extends Controller
{
    public function __invoke(){
        $dia_hoy = date("d");
        $mes_hoy = date("m");
        $ubicaciones = DB::table('artefactos')->select('UBICACION','NIVEL')->where("DAY",$dia_hoy)->where("MONTH",$mes_hoy)->get();
        $gmap = new GMaps();
        $config['center'] = 'Toesca, Chile';
        $config['zoom'] = '15';
        $config['map_height'] = '500px';
        $config['scrollwheel'] = false;
        $gmap->initialize($config);

        $marker['position'] = 'Santiago 1390, Santiago';
        $marker['infowindow_content'] = 'Santiago 1390, Centro de Operaciones';
        $marker['icon'] = 'http://maps.google.com/mapfiles/ms/micons/truck.png';
        $gmap->add_marker($marker);

        for($i=0;$i<count($ubicaciones);$i++){
            $marker['position'] = (string)$ubicaciones[$i]->UBICACION.', Santiago';
            $marker['infowindow_content'] = (string)$ubicaciones[$i]->UBICACION.', Nivel: '.(string)$ubicaciones[$i]->NIVEL.'%';
            $marker['icon'] = 'http://maps.google.com/mapfiles/ms/micons/recycle.png';
            $gmap->add_marker($marker);
        }

        $config['directionsStart'] = 'Santiago 1390, Santiago';
        $config['directionsEnd'] = 'Vergara 432, Santiago';
        $config['directionsDivID'] = 'directionsDiv';

        $map = $gmap->create_map();
        return view('map')->with('map',$map);
    }
}
