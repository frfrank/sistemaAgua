@extends('seguridad.menuUsuario')

@section('contenidoUsuario')
<div class="container">
<br>
<div class="alert alert-dark" role="alert">
  Usuarios del Sistema
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Usuario</th>
      <th scope="col">Email</th>
      <th scope="col">Estado</th>
    </tr>
    <tr>
    <td></td>
    <td><input type="text" class="form-control"></td>
    <td><input type="text" class="form-control"></td>
    <td><select class="form-control">
        <option value="1">ACTIVO</option>
        <option value="0">BLOQUEADO</option>

    </select></td>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto@gmail.com</td>
      <td><span class="badge badge-success text-center">ACTIVO</span></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton@gmail.com</td>
      <td><span class="badge badge-pill badge-danger" >BLOQUEADO</span></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>theBird@gmail.com</td>
      <td><span class="badge badge-success text-center">ACTIVO</span></td>
      
    </tr>
  </tbody>
</table>
</div>
@endsection