<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
date_default_timezone_set("Chile/Continental");
class ContenedoresController extends Controller
{
    public function index(){
        $dia_hoy = date("d");
        $mes_hoy = date("m");
        $contenedores = DB::table('artefactos')->where("DAY",$dia_hoy)->where("MONTH",$mes_hoy)->get();
        return view('contenedores.index',['contenedores'=>$contenedores]);
    }

    public function show($id){
        return view('contenedores.show',compact('id'));
    }

    public function create(){
        return 'Ingresar nuevo contenedor: ';
    }
}
