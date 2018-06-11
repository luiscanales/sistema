<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        
        $artefactos = DB::table('artefactos')->select('FECHA','NIVEL')->where('UBICACION','VERGARA 432')->orderBy("FECHA")->get();
        
        $artefactos2 = DB::table('artefactos')->select('FECHA','NIVEL')->where('UBICACION','GRAJALES 2395')->orderBy("FECHA")->get();

        $artefactos3 = DB::table('artefactos')->select('FECHA','NIVEL')->where('UBICACION','NATANIEL COX 153')->orderBy("FECHA")->get();

        $incidente = DB::table('artefactos')->where('INCIDENTE','SI')->count();
        $noincidente = DB::table('artefactos')->where('INCIDENTE','NO')->count();
        
        //$test = ['incidente'=>$incidente,'noincidente'=>$noincidente];
        for ($i = 0; $i<count($artefactos);$i++){
            $artefactos[$i]->NIVEL2 = $artefactos2[$i]->NIVEL;
            $artefactos[$i]->NIVEL3 = $artefactos3[$i]->NIVEL;
        }
    return view('dashboard')->with(['artefactos'=>$artefactos])->with('incidente',$incidente)->with('noincidente',$noincidente);
    }
}
