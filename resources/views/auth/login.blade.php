@extends('auth.contenido')

@section('login')
	<form class="form-control">
	<div class="row">
	<div class="col-md-4 offset-md-4">
	<div class="form-group">
	<input type="text" class="form-control" name="nombreUsuario" >
	</div>
	</div>	
	</div>

	<div class="row">
	<div class="col-md-4 offset-md-4">
	<div class="form-group">
	<input type="password" class="form-control" name="password" >
	</div>
	</div>	
	</div>

	<div class="row">
	<div class="col-md-4 offset-md-4">
	<button type="submit" class="btn btn-success">Acceder</button>
	</div>	
	</div>
	<form>

@endsection