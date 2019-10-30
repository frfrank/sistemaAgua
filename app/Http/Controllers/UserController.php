<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\PerfilUsuario;

class UserController extends Controller
{
       
    public function vistaUsuarios(){
        return view('seguridad.menuUsuario');
    }
    public function createUsuario(){
        return view('seguridad.createUsuario');
    }
    public function listaUsuario(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscarUsuario;   
        
        if ($buscar==''){
            $perfil = User::join('perfil_usuario','users.id','=','perfil_usuario.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('perfil_usuario.id','perfil_usuario.nombre','perfil_usuario.apellidos','perfil_usuario.email',
             'users.id as idusuario','users.nombreUsuario','users.password' ,'users.estado','users.idrol','roles.nombre as rol')
            ->orderBy('perfil_usuario.id', 'desc')->paginate(5);
        }
        else{            
            $perfil = User::join('perfil_usuario','users.id','=','perfil_usuario.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('perfil_usuario.id','perfil_usuario.nombre','perfil_usuario.apellidos','perfil_usuario.email',
            'users.id as idusuario','users.nombreUsuario','users.password' ,'users.estado','users.idrol','roles.nombre as rol')
            ->where('personas.nombre', 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return [
            'pagination' => [
                'total'        => $perfil->total(),
                'current_page' => $perfil->currentPage(),
                'per_page'     => $perfil->perPage(),
                'last_page'    => $perfil->lastPage(),
                'from'         => $perfil->firstItem(),
                'to'           => $perfil->lastItem(),
            ],
            'perfil' => $perfil
        ];
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $perfil=new PerfilUsuario;                
            $perfil->nombre = $request->nombre;
            $perfil->apellidos=$request->apellidos;
            $perfil->email=$request->email;
            $perfil->save();

            $user=new User;
            $user->id=$perfil->id;
            $user->nombreUsuario=$request->nombreUsuario;
            $user->password=bcrypt($request->password);
            $user->idrol=$request->idrol;
            $user->estado=1;
            $user->save();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollBack();
        }

    }
    public function update(Request $request){
        try{
            DB::beginTransaction();            
            $user = User::findOrFail($request->id);
            $perfil = PerfilUsuario::findOrFail($user->id);                       
            $perfil->nombre = $request->nombre;
            $perfil->apellidos=$request->apellidos;
            $perfil->email=$request->email;
            $perfil->save();
            
            $user->nombreUsuario=$request->nombreUsuario;
            $user->password=bcrypt($request->password);
            $user->idrol=$request->idrol;
            $user->estado=1;
            $user->save();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollBack();
        }
    }
    public function cargarRoles(){
        $roles = DB::table('roles')
        ->select('id', 'nombre')
        ->where('estado','=',1)
        ->get();
        return $roles;
    }
   
}
