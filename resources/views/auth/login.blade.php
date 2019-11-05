@extends('auth.contenido')

@section('login')
<div class="jumbotron mx-auto">
  <h1 class="display-4">Bienvenidos!</h1>
  <p class="lead">SAAUSN al servicio de la comunidad</p>
  <hr class="my-4">
  <form method="POST" action="{{route('login')}}">
  {{ csrf_field() }}

	<div class="row">
	<div class="col-md-4 offset-md-4">
	<div class="form-group mb-3{{$errors->has('nombreUsuario' ? 'is-invalid' : '')}}"">
	<label for="NombreUsuario">Usuario</label>
	<input type="text" value="{{old('nombreUsuario')}}" class="form-control" name="nombreUsuario" id="nombreUsuario">
	{!!$errors->first('nombreUsuario','<span class="invalid-feedback">:message</span>')!!}
	</div>
	</div>	
	</div>

	<div class="row">
	<div class="col-md-4 offset-md-4">
	<div class="form-group">
	<label>Contraseña</label>

	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
	{!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
	</div>
	</div>	
	</div>

	<div class="row">
	<div class="col-md-4 offset-md-4">
	<button type="submit" class="btn btn-success">Acceder</button>
	</div>	
	</div>
	<form>

</div>


@endsection