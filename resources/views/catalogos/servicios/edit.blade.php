@extends('template.principal')
@section('seccion')
<div class="container">
<br>
<div class=row>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="text-success"><strong>Editar Servicio: {{$servicio->nombre}}</strong></h4>  
  </div>
</div>
<!--Inicio del Formulario-->
<div class="container">
<form method="POST" action="{{route('actualizarServicio')}}">
    {{ csrf_field()}}
    <div class="form-group">
    <input type="hidden" name=id class="form-control" value="{{$servicio->id}}">
    </div>

    <div class="form-group">
    <label for="nombre">Nombre : </label>
    <input type="text" name=nombre class="form-control" value="{{$servicio->nombre}}">
    </div>

    <div class="form-group">
    <label for="descripcion">Descripción : </label>
    <input type="text" name=descripcion class="form-control" value="{{$servicio->descripcion}}">
    </div>
    <div class="form-group">
    <label for="precio">Precio : </label>
    <input type="number" name=precioServicio class="form-control" value="{{$servicio->precioServicio}}">
    </div>
    <div class="form-group">
    <label for="estado">Estado : </label>
    <select name="estado" id="" class="form-control">
    @if($servicio->estado==1)
        <option value="1" selected>ACTIVO</option>
        <option value="0">INACTIVO</option>
    @endif
    @if($servicio->estado==0)
        <option value="1" >ACTIVO</option>
        <option value="0" selected>INACTIVO</option>
    @endif
    </select>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-success">Actualizar</button>
    </div>
</form>
</div>
<br><br>
</div>
@endsection