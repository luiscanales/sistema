<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContenedoresController extends Controller
{
    public function index(){
        $contenedores = DB::table('artefactos')->where("FECHA","08/06/18")->get();
        return view('contenedores.index',['contenedores'=>$contenedores]);
    }

    public function show($id){
        return view('contenedores.show',compact('id'));
    }

    public function create(){
        return 'Ingresar nuevo contenedor: ';
    }
}
