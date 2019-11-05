<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Persona;
use App\Comunidad;

class ClienteController extends Controller
{
    public function index() {
        return view('cliente.index');
    }

    public function listaClientes(Request $request) {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;

        if ($buscar == '') {
            $persona = Persona::join('comunidades','idcomunidad','=','comunidades.id')
            ->select('personas.id','personas.nombre','personas.apellido','personas.cedula',
            'personas.tipoDocumento',
            DB::raw('concat(personas.nombre, " ", personas.apellido) as nombreCompleto'),
            'personas.lugarNacimiento', 'personas.edad',
            'personas.descripcion','personas.telefono','personas.direccion','comunidades.id as idcomunidad',
            'comunidades.nombre as nombreComunidad','personas.estado')
            ->orderBy('personas.id', 'desc')->paginate(5); //Traigo todos los datos y los ordeno de manera descendente
        } else {            
            $persona = Persona::join('comunidades','idcomunidad','=','comunidades.id')
            ->select('personas.id','personas.nombre','personas.apellido','personas.cedula',
            'personas.tipoDocumento',
            DB::raw('concat(personas.nombre, " ", personas.apellido) as nombreCompleto'),
            'personas.lugarNacimiento', 'personas.edad',
            'personas.descripcion','personas.telefono','personas.direccion','comunidades.id as idcomunidad',
            'comunidades.nombre as nombreComunidad','personas.estado')
            ->where('personas.nombre', 'like', '%' . $buscar . '%')
            ->orWhere('personas.apellido', 'like', '%' . $buscar . '%')

            ->orderBy('personas.id', 'desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total' => $persona->total(),
                'current_page' => $persona->currentPage(),
                'per_page' => $persona->perPage(),
                'last_page' => $persona->lastPage(),
                'from' => $persona->firstItem(),
                'to' => $persona->lastItem(),
            ],
            'persona' => $persona
        ];
    }
    public function listarComunidad(){
        $comunidad=DB::table('comunidades')
        ->select('id','nombre')
        ->where('estado','=','1')
        ->get();
        return $comunidad;
    }
    public function listaVerificarCedula(){
        $cedula = DB::table('Personas')
        ->select('id', 'nombre','cedula')->get();
        return $cedula;
    }
    public function create() {
        return view('cliente.create');
    }
    
    public function store(Request $request) {
       //  if (!$request->ajax()) return redirect('/');
        
        $cliente = new Persona;
        $cliente->nombre = $request->nombre;
        $cliente->apellido=$request->apellido;
        $cliente->telefono=$request->telefono;
        $cliente->tipoDocumento=$request->tipoDocumento;
        $cliente->cedula=$request->cedula;   
        $cliente->edad=$request->edad; 
        $cliente->direccion=$request->direccion;
        $cliente->lugarNacimiento=$request->lugarNacimiento; 
        $cliente->descripcion = $request->descripcion;
        $cliente->idcomunidad=$request->comunidad;
        $cliente->estado = $request->estado;
        $cliente->save();
        
       
    }

    public function update(Request $request) {
        // if (!$request->ajax()) return redirect('/');
        $cliente = Persona::findOrFail($request->id);        
        $cliente->nombre = $request->nombre;
        $cliente->apellido=$request->apellido;
        $cliente->telefono=$request->telefono;
        $cliente->tipoDocumento=$request->tipoDocumento;
        $cliente->cedula=$request->cedula;   
        $cliente->edad=$request->edad; 
        $cliente->direccion=$request->direccion;
        $cliente->lugarNacimiento=$request->lugarNacimiento; 
        $cliente->descripcion = $request->descripcion;
        $cliente->idcomunidad=$request->comunidad;
        $cliente->estado = $request->estado;
        $cliente->save();
    }

    public function activar(Request $request) {
        $cliente = Persona::findOrFail($request->id);
        $cliente->estado  = 1;
        $cliente->save();
    }

    public function desactivar(Request $request) {
        $cliente = Persona::findOrFail($request->id);
        $cliente->estado = 0;
        $cliente->save();
    }
    public function destroy(Request $request){
        $id=$request->id;
        $cliente= DB::table('personas')
             ->where('id', '=',$id)->delete();         
 
    }
}
