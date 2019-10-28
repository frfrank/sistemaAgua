@extends('template.principal')
@section('seccion')
<div class="container" ng-app="myApp" ng-controller="MyController">
<h3>Seguridad</h3>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuarios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Roles</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Rutas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Asignaciones</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <br>
  <div class="alert alert-success" role="alert">
  Usuarios
</div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
  </div>
  <!--segundo panel  para mostra Roñles-->
 <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <br>
  <div class="row">
  <div class="col-md-10">
  <h3 class="text-success">Roles</h3>  
  </div>
  <div class="col-md-2">
  <a href="" class="btn btn-success" ng-click="abrirModal('rol','nuevo')"><i class="fa fa-plus"></i> Nuevo Rol</a>
  </div>
  </div>
  <div  ng-if="elementos.length>0" class="text-primary">
           Mostrando  @{{elementos.length}} de @{{totalRegistros}} Registros
</div>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Estado</th>
      <th></th> 
    </tr>
  </thead>
  <tbody>
    <tr>
      <td></td>
      <td><input type="text" ng-model="buscar" class="form-control" ng-keydown="listarRoles(1,buscar)"></td>
      <td><input type="text" class="form-control"></td>
      <td></td>
      <td></td>
    </tr>
    <tr ng-repeat="(index, lis) in elementos">
    <th scope="row">@{{index +1}}</th>
      <td>@{{lis.nombre }}</td>
      <td>@{{lis.descripcion}}</td>
      <td ng-if="lis.estado==1"><span class="badge badge-success">ACTIVO</span></td>
      <td ng-if="lis.estado==0"><span class="badge badge-danger">INACTIVO</span></td>
      <td><a href="" ><i class="fa fa-pencil text-primary" ng-click="abrirModal('rol','actualizar',lis)" title="Editar"></i></a>
      <a href=""  ng-if="lis.estado==1"ng-click="desactivarRol(lis)"><i class="fa fa-trash text-danger" title="Desactivar"></i></a>
      <a href=""  ng-if="lis.estado==0"ng-click="activarRol(lis)"><i class="fa fa-check-square text-success" title="Activar"></i></a>
    
      </td>  
    </tr>    
  </tbody>
</table>
<nav aria-label="...">
    <ul class="pagination">
    <li class="page-item" ng-if="pagination.current_page>1">
      <a class="page-link" href="#" tabindex="-1" ng-click="cambiarPagina(pagination.current_page-1)">Ant</a>
    </li>
    <li ng-repeat="page in pages" class="page-item"><a class="page-link"  href="#" ng-click="cambiarPagina(page)">@{{page}}</a></li>
      <li class="page-item" ng-if="pagination.current_page<pagination.last_page">
      <a class="page-link" href="#" ng-click="cambiarPagina(pagination.current_page+1)">Sig</a>
    </li>
    </ul>
    </nav>
    <br><br>  
  </div>
<!--Fin del segundo panel -->

  <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
  <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
</div>


  <!--Modal para guardar y actualizar el Registro -->
  <div class="modal" tabindex="-1"  ng-class="{'mostrar' : modal}" role="dialog" id="mostrarFormulario">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">@{{tituloModal}}</h5>
                <button type="button" class="close" ng-click="cerrarModal()" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">        
                <form>
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input type="text" ng-model="nombre"  class="form-control @{{isvalido}}">
                        <span class="text-danger" ng-show="nombre<1"> @{{errorMostrarMsj}}</span>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" ng-model="descripcion" name="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" ng-model="estado">
                            <option ng-value="1" selected>ACTIVO</option>
                            <option ng-value="0">INACTIVO</option>
                        </select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ng-click="cerrarModal()" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary"  ng-show="botonGuardar" ng-click="guardarRol()">Guardar Cambios</button>
                <button type="button" class="btn btn-success"  ng-hide="botonGuardar" ng-click="actualizarRol()">Actualizar Cambios</button>
              </div>
            </div>
          </div>
<!-- fin del modal de actualizar y guardar-->


</div>

  
<script src="{{ asset('angularjs/angular.min.js')}}"></script>   
    <script src="{{ asset('js/seguridad/general.js')}}"></script>   
    
<style >
        .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
       .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }    
    .iniciobarra{
      width:0%;
    }
    .finbarra{
      width:100%;
    }
    .animacion{
      transition: all 2s ease .5s;
    }
</style>
@endsection

