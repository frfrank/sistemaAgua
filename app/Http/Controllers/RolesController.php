<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Roles;


class RolesController extends Controller
{
    
    public function index() {
        return view('catalogos.roles.index');
    }

    public function listaRoles(Request $request) {

        $buscar = $request->buscar;

        if ($buscar == '') {
            $roles = Roles::orderBy('id', 'desc')->paginate(5); //Traigo todos los datos y los ordeno de manera descendente
        } else {
            $roles = Roles::where('nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->lastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->lastItem(),
            ],
            'roles' => $roles
        ];
    }
    public function listaVerificarNombre(){
        $roles = DB::table('Roles')
        ->select('id', 'nombre')->get();
        return $roles;
    }
        public function store(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $roles = new Roles();
        $roles->nombre = $request->nombre;
        $roles->descripcion = $request->descripcion;
        $roles->estado = $request->estado;
        $roles->save();
    }

    public function update(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $roles = Roles::findOrFail($request->id);
        $roles->nombre = $request->nombre;
        $roles->descripcion = $request->descripcion;
        $roles->estado = $request->estado;
        $roles->save();
    }

    public function activar(Request $request) {
        $roles = Roles::findOrFail($request->id);
        $roles->estado  = 1;
        $roles->save();
    }

    public function desactivar(Request $request) {
        $roles = Roles::findOrFail($request->id);
        $roles->estado  = 0;
        $roles->save();
    }
}
