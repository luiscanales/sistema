<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(){
        $users = DB::table('users')->get();
        $title = 'Listado de Usuarios';
        return view('users.index',compact('title','users'));
    }
    public function show($id){
        return view('users.show',compact('id'));
    }

    public function create(){
        return 'Crear nuevo usuario';
    }
}
