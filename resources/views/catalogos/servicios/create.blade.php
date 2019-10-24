@extends('template.principal')
@section('seccion')
<div class="container">
<br>
<div class=row>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4 class="text-primary"><strong>Nuevo Servicio</strong></h4>    
    </div>
</div>
<!--Inicio del Formulario-->
<div class="container">
<form method="POST" action="{{route('guardarServicio')}}">
    {{ csrf_field()}}

    <div class="form-group">
    <label for="nombre">Nombre : </label>
    <input type="text" name=nombre class="form-control">
    </div>

    <div class="form-group">
    <label for="descripcion">Descripción : </label>
    <input type="text" name=descripcion class="form-control">
    </div>
    <div class="form-group">
    <label for="precio">Precio : </label>
    <input type="number" name=precioServicio class="form-control">
    </div>
    <div class="form-group">
    <label for="estado">Estado : </label>
    <select name="estado" id="" class="form-control">
        <option value="1">ACTIVO</option>
        <option value="0">INACTIVO</option>
    </select>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-success">Guardar</button>
    </div>
</form>
</div>
<br><br>
</div>
@endsection