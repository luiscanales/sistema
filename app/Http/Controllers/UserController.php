<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = [
            'Toesca',
            'Parque O\'Higgins',
            'Rondizzoni',
            'República',
            'Gorbea',
        ];

        $title = 'Listado de Contenedores';

        return view('users.index',compact('title','users'));

    }

    public function show($id){
        return view('users.show',compact('id'));
    }

    public function create(){
        return 'Crear nuevo usuario';
    }
}
