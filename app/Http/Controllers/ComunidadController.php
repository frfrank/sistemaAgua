<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Comunidad;

class ComunidadController extends Controller
{
    public function index() {
        return view('catalogos.comunidad.index');
    }

    public function listaComunidades(Request $request) {

        $buscar = $request->buscar;

        if ($buscar == '') {
            $comunidad = comunidad::orderBy('id', 'desc')->paginate(5); //Traigo todos los datos y los ordeno de manera descendente
        } else {
            $comunidad = comunidad::where('nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $comunidad->total(),
                'current_page' => $comunidad->currentPage(),
                'per_page' => $comunidad->perPage(),
                'last_page' => $comunidad->lastPage(),
                'from' => $comunidad->firstItem(),
                'to' => $comunidad->lastItem(),
            ],
            'comunidad' => $comunidad
        ];
    }
    
    public function listaVerificarNombre(){
        $comunidad = DB::table('comunidades')
        ->select('id', 'nombre')->get();
        return $comunidad;
    }
    
    public function store(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $comunidad = new Comunidad();
        $comunidad->nombre = $request->nombre;
        $comunidad->descripcion = $request->descripcion;
        $comunidad->estado = $request->estado;
        $comunidad->save();
    }

    public function update(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $comunidad = Comunidad::findOrFail($request->id);
        $comunidad->nombre = $request->nombre;
        $comunidad->descripcion = $request->descripcion;
        $comunidad->estado = $request->estado;
        $comunidad->save();
    }

    public function activar(Request $request) {
        $comunidad = Comunidad::findOrFail($request->id);
        $comunidad->estado  = 1;
        $comunidad->save();
    }

    public function desactivar(Request $request) {
        $comunidad = Comunidad::findOrFail($request->id);
        $comunidad->estado = 0;
        $comunidad->save();
    }
    
}
