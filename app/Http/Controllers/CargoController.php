<?php

namespace App\Http\Controllers;

use App\Cargo;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Exports\CargosExport;
use Maatwebsite\Excel\Facades\Excel;

class CargoController extends Controller {
    //

    public function index() {
        return view('cargo.cargo');
    }

    public function listaCargos(Request $request) {

        $buscar = $request->buscar;

        if ($buscar == '') {
            $cargo = Cargo::orderBy('id', 'desc')->paginate(5); //Traigo todos los datos y los ordeno de manera descendente
        } else {
            $cargo = Cargo::where('nombre', 'like', '%' . $buscar . '%')
                ->orderBy('id', 'desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $cargo->total(),
                'current_page' => $cargo->currentPage(),
                'per_page' => $cargo->perPage(),
                'last_page' => $cargo->lastPage(),
                'from' => $cargo->firstItem(),
                'to' => $cargo->lastItem(),
            ],
            'cargo' => $cargo
        ];
    }
    public function listaVerificarNombre(){
        $cargo = DB::table('cargos')
        ->select('id', 'nombre')->get();
        return $cargo;
    }
    public function destroy(Request $request){
       $id=$request->id;
       $cargo= DB::table('cargos')
            ->where('id', '=',$id)->delete();         

    }

    public function store(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $cargo = new Cargo();
        $cargo->nombre = $request->nombre;
        $cargo->descripcion = $request->descripcion;
        $cargo->estado = $request->estado;
        $cargo->save();
    }

    public function update(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $cargo = Cargo::findOrFail($request->id);
        $cargo->nombre = $request->nombre;
        $cargo->descripcion = $request->descripcion;
        $cargo->estado = $request->estado;
        $cargo->save();
    }

    public function activar(Request $request) {
        $cargo = Cargo::findOrFail($request->id);
        $cargo->estado = $request->estado = 1;
        $cargo->save();
    }

    public function desactivar() {
        $cargo = Cargo::findOrFail($request->id);
        $cargo->estado = $request->estado = 0;
        $cargo->save();
    }
    public function exportarExcel(){
        return Excel::download(new CargosExport, 'cargos.xlsx');
    }

}
