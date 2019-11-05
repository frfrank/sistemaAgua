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
        $this->validateLogin($request);    
     
        if (Auth::attempt(['nombreUsuario' => $request->nombreUsuario, 'password' => $request->password, 'estado' => 1])) {
            return redirect()->route('inicio');
        }
        
            return back()
            ->withErrors(['nombreUsuario' => trans('auth.failed')])
            ->withInput(request(['nombreUsuario']));

      

    }
    protected function validateLogin(Request $request){
        $this->validate($request,[
            'nombreUsuario' => 'required|string',
            'password' => 'required|string'
        ]);

    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
