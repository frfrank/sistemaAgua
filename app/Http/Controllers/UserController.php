<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
       
    public function vistaUsuarios(){
        return view('seguridad.menuUsuario');
    }
}
