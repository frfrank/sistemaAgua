@extends('template.principal')
@section('seccion')

<div class="container">
  <h1 class="text-success"><i class="fa fa-list-ul"></i> Lista de Cargos</h1>
</div>


<div class="container" ng-app="myApp" ng-controller="MyController">
<div class="row">
    <div class="col-md-2">
        <br>
<button type="button" class="btn btn-success" ng-click="abrirModal('cargo','nuevo')">  Nuevo Cargo </button>
</div>
<div class="col-md-8"></div>
<div class="col-md-2">
<br>
<a href="{{route('exportarcargo')}}" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
Descargar Excel<a>
</div>

 <br><br><br>
 </div>
 <div >
  <form action="">
  <input type="text" ng-model="buscar" placeholder="Búsqueda por Nombre" ng-keydown="listarcargos(1,buscar)" class="form-control">
  </form>
 </div>
 <br>
 
 <p class="text-primary" ng-if="elementos.length>0"> Mostrando  @{{elementos.length}} de @{{totalRegistros}} Registros</p>

<table class="table">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-primary" ng-model="ordenarPor" >
            Nombre             
            <a href="" ><i class="fa fa-arrow-down"  style="font-size:15px"  ng-click="ordenar('ordenarMenorAMayor')"></i></a>            
            <a href><i class="fa fa-arrow-up"  ng-hide="mostrar==1" style="font-size:15px"  ng-click="ordenar('ordenarMayorAMenor')"></i></a>
          </th>
            <th scope="col" class="text-primary" ng-model="ordenarPor">
            Descripción            
            <a href="" ><i class="fa fa-arrow-down"  style="font-size:15px"  ng-click="ordenar('ordenarMenorAMayorDescripcion')"></i></a>            
            <a href><i class="fa fa-arrow-up"  ng-hide="mostrar==1" style="font-size:15px"  ng-click="ordenar('ordenarMayorAMenorDescripcion')"></i></a>
            </th>
            <th scope="col" class="text-primary">Estado</th>
                </tr>
            </thead>           

            <tbody>
          <tr ng-if="elementos.length<1"> <td colspan="5"><h3 class="text-success text-center">No hay Datos que Mostrar</h3></td></tr>
          <tr><div class="progress" ng-hide="elementos.length">
          <div class="progress-bar iniciobarra animacion " id="barra" role="progressbar"   aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
          </div></tr>
             <tr ng-repeat="(index, lis) in elementos| orderBy:ordenarPor">
                            <th scope="row">@{{index +1}}</th>
                            <td>@{{lis.nombre }}</td>
                            <td>@{{lis.descripcion}}</td>
                            <td ng-if="lis.estado==1"><span class="badge badge-success">Activo</span></td>
                            <td ng-if="lis.estado==0"><span class="badge badge-danger">Inactivo</span></td>
                            <td><a href="" ><i class="fa fa-pencil text-primary" ng-click="abrirModal('cargo','actualizar',lis)" title="Editar"></i></a>
                           <a href="" ng-click="eliminarCargo(lis)"><i class="fa fa-trash text-danger" title="Eliminar Cargo"></i></a>
                            </td>                         
                        </tr>                      
                        </tbody>
                        <nav aria-label="Page navigation example">             
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
                            <option ng-value="1" selected>Activo</option>
                            <option ng-value="0">Inactivo</option>
                        </select>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" ng-click="cerrarModal()" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary"  ng-show="botonGuardar" ng-click="guardarCargo()">Guardar Cambios</button>
                <button type="button" class="btn btn-success"  ng-hide="botonGuardar" ng-click="actualizarCargo()">Actualizar Cambios</button>
              </div>
            </div>
          </div>
                </div>
    
    <script src="{{ asset('angularjs/angular.min.js')}}"></script>   
    <script src="{{ asset('js/cargo.js')}}"></script>   
    
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