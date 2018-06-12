<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IncidentesController extends Controller
{
    public function __invoke(){
        $contenedores = DB::table('artefactos')->where("INCIDENTE","SI")->get();
        return view('incidentes',['contenedores'=>$contenedores]);
    }
}
