<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;


use App\Servicio;

class ServicioController extends Controller
{
    public function index(Request $request){
      //  $servicio=Servicio::all();
        $query=trim($request->get('searchText'));
       if($query==''){
        $servicio=Servicio::orderBy('id','desc')->paginate(5);
       }
       else{
        $servicio=Servicio::where('nombre','LIKE', '%' . $query . '%')
        ->orderBy('id','desc')
        ->paginate(5);        
       }
       return view('catalogos.servicios.index',["servicio"=>$servicio,"searchText"=>$query]);        
        
    }
    public function create(){
        return view('catalogos.servicios.create');
    }
    public function store(Request $request){
        $servicio= new Servicio;
        $servicio->nombre=$request->get('nombre');
        $servicio->descripcion=$request->get('descripcion');
        $servicio->precioServicio=$request->get('precioServicio');
        $servicio->estado=$request->get('estado');
        $servicio->save();
        Flash::success("Se ha registrado " . $servicio->nombre . " de forma exitosa")->important();

        return Redirect::to('/servicio/index');

    }
    public function edit($id){        
        return view("catalogos.servicios.edit",["servicio"=>Servicio::findOrFail($id)]);
    }
    public function update(Request $request){
        $servicio=Servicio::findorFail($request->id);        
        $servicio->nombre=$request->nombre;
        $servicio->descripcion=$request->descripcion;
        $servicio->precioServicio=$request->precioServicio;
        $servicio->estado=$request->estado;
        $servicio->save();
        Flash::success("Se ha Actualizado " . $servicio->nombre . " de forma exitosa")->important();
        return Redirect::to('/servicio/index');

    }
    public function eliminar($id){        
        return view("catalogos.servicios.modal",["servicio"=>Servicio::findOrFail($id)]);
    }
    public function destroy(Request $request){
        $id=$request->id;
        $servicio= DB::table('servicios')
        ->where('id', '=',$id)->delete();
        flash('Eliminado Exitosamente')->important();
        return Redirect::to('/servicio/index');
    }
    public function listarServicios(){
        $servicio=Servicio::all();
        return $servicio;
    }

}
