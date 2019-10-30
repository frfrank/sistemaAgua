@extends('template.principal')

@section('seccion')
<div class="container">
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header" style="background:#449D44;color:white">
        <h5 class="modal-title" id="exampleModalLabel" >Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      <div class="modal-body">
        <form>
        <div class="row">
        <div class="col-lg-6">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombres:</label>
            <input type="text" ng-model="nombreUsuario" class="form-control" id="recipient-name">
          </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Apellidos:</label>
            <input type="text"  ng-model="apellidoUsuario" class="form-control" id="recipient-name">
          </div>
        </div>
        </div>
        <!--segunda FILA-->
        <div class="row">
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tipo Documento:</label>
            <select  ng-model="tipoDocumento" class="form-control">
                <option value="CEDULA">CEDULA</option>
                <option value="PASAPORTE">PASAPORTE</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Cedula:</label>
            <input type="text" ng-model="nombreUsuario" class="form-control" id="recipient-name">
          </div>
        </div>
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Edad:</label>
            <input type="text"  ng-model="edad" class="form-control">
          </div>
        </div>
        </div>
        
          <!--TERCERA FILA-->
          <div class="row">
        <div class="col-lg-6">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Usuario :</label>
            <input type="text" ng-model="usuario" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Contraseña:</label>
            <input type="password" ng-model="password" class="form-control">
          </div>
        </div>
       </div>
        <div class="row">
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text"  ng-model="email" class="form-control">
          </div>
        </div>
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Roles:</label>
            <select  ng-model="rol" class="form-control">
                <option value="CEDULA">ADMINISTRADOR</option>
                <option value="PASAPORTE">PASAPORTE</option>
            </select>
          </div>
        </div>
        
        <div class="col-lg-4">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Estado:</label>
            <select  ng-model="estado" class="form-control">
                <option value="1">ACTIVO</option>
                <option value="0">BLOQUEADO</option>
            </select>
          </div>
        </div>

        </div>
        </form>



</div>


@endsection