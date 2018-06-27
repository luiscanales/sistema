<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;

class RutaController extends Controller
{
    public function __invoke(){
        //$directionsWaypointArray = array();
        $dia_hoy = date("d");
        $mes_hoy = date("m");
        $nivel = 70;
        $ubicaciones = DB::table('artefactos')->select('UBICACION')
        ->where('DAY',$dia_hoy)->where('MONTH',$mes_hoy)->where('NIVEL','>',$nivel)->get();
        //dd($ubicaciones);
        $gmap = new GMaps();
        $config['center'] = 'Toesca, Chile';
        $config['zoom'] = '15';
        $config['map_height'] = '500px';
        $config['scrollwheel'] = false;
        $config['trafficOverlay'] = TRUE;
        $config['directions'] = TRUE;
        $config['directionsMode']="DRIVING";
        $config['directionsStart'] = 'Santiago 1390, Santiago';
        $config['directionsEnd'] = 'Santiago 1390, Santiago';
        for($i=0;$i<count($ubicaciones);$i++){
            $config['directionsWaypointArray'][$i] = (string)$ubicaciones[$i]->UBICACION.', Santiago';
        }
        $config['directionsDivID'] = 'directionsDiv';
        $gmap->initialize($config);
        $map = $gmap->create_map();
        return view('ruta')->with('map',$map);
    }
}
