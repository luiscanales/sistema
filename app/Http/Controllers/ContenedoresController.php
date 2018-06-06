<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContenedoresController extends Controller
{
    public function index(){
        $contenedores = [
            'Toesca',
            'Parque O\'Higgins',
            'Rondizzoni',
            'República',
            'Gorbea',
        ];

        $title = 'Listado de Contenedores';

        return view('contenedores.index',compact('title','contenedores'));
    }

    public function show($id){
        return view('contenedores.show',compact('id'));
    }

    public function create(){
        return 'Ingresar nuevo contenedor: ';
    }
}
