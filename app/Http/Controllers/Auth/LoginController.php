<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;



class LoginController extends Controller
{
    public function abrirLogin(){
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $nombre=$request->nombreUsuario;
        $password=$request->password;

        if (Auth::attempt(['nombreUsuario' => $nombre, 'password' => $password, 'estado' => 1])) {
            return redirect()->route('inicio');

        }
        
    }
    
  
}
