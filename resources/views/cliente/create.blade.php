
 <!-- FORMULARIO PARA GUARDAR Y EDITAR-->
  <!--Inicio del Formulario-->
  <div class="container" ng-show="mostrar==1">
<div class="container">
<br>
<div class=row>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 class="text-success"><strong><i class="fa fa-file"></i> Nuevo Cliente</strong></h3>    
    </div>
</div>
<hr>
<form>
    {{ csrf_field()}}
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="nombre" class="text-primary">Nombre : </label>
            <input type="text" ng-model="nombre"  id="capitalize" class="form-control">
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="apellido" class="text-primary">Apellidos : </label>
            <input type="text" ng-model="apellido" id="capitalize" class="form-control">
            </div>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="telefono" class="text-primary">Teléfono : </label>
            <input type="text" ng-model="telefono" class="form-control">
            </div>
        </div>
    </div>    
    <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cedula" class="text-primary">Tipo Documento : </label>
            <select class="form-control" ng-model="tipoDocumento">
            <option value="CEDULA">CEDULA</option>
            <option value="PASAPORTE">PASAPORTE</option>
            </select>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="cedula" class="text-primary" >Cédula : </label>
            <input type="text" ng-model="cedula" id="cedula" class="form-control" ng-keypress="operacionCedula()">
            </div>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="edad" class="text-primary">Edad : </label>
            <input type="number" ng-model="edad"  class="form-control">
            </div>
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="lugarNacimiento" class="text-primary">Lugar de Nacimiento : </label>
            <input type="text" ng-model="lugarNacimiento"  class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
            <label for="descripcion" class="text-primary"> Descripción: </label>
            <textarea row="4" ng-model="descripcion" class="form-control"></textarea>
        </div>
        </div>               
    </div>
    <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
            <label for="comunidad" class="text-primary"> Comunidad: </label>
            <select class="form-control" ng-model="comunidad" >
            <option  ng-repeat="item in comunidades" value="@{{item.id}}" > @{{item.nombre}}</option>
            </select>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
            <label for="direccion" class="text-primary"> Dirección: </label>
            <textarea row="2" ng-model="direccion" class="form-control"></textarea>
        </div>
        </div>               
    </div>
    <div class="row">
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
            <label for="estado" class="text-primary"> Estado: </label>
            <select class="form-control" ng-model="estado">
            <option value="1">ACTIVO</option>
            <option value="0">INACTIVO</option>
            </select>
        </div>
        </div>
        </div>
               
    </div>    
</form>
      <div class="container">      
    <div class="row">
        <div class="col-md-6">
        <button class="btn btn-success" ng-click="guardarCliente()" > Guardar</button>
        <button class="btn btn-danger" ng-click="ocultarFormulario()">Cancelar</a>
        </div>
        </div></div>
<!-- Fin del Formulario-->
</div>
<br><br>
</div>
<!-- FIN DEL FORMULARIO PARA GUARDAR-->
  