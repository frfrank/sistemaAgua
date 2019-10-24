@extends('template.principal')
@section('seccion')
<style>
     #cedula {
            text-transform: uppercase;
        }
    #capitalize{
        text-transform: capitalize;
    }
    </style>

<div class="container" ng-app="myApp" ng-controller="MyController" >
<!-- Inicio del lISTADO-->
<div ng-show="mostrar==0">
<div class="row">
  <h1 class="text-success"><i class="fa fa-list-ul"></i> Lista de Clientes</h1>
</div>
<div class="row">
    <div class="col-md-2">
        <br>
<button class="btn btn-success" ng-click="mostrarFormulario()">  Nuevo Cliente </button>
</div>
<div class="col-md-8"></div>


 <br><br><br>
 </div>
 <div >
  <form action="">
  <input type="text" ng-model="buscar" placeholder="Búsqueda por Nombre" ng-keydown="listarclientes(1,buscar)" class="form-control">
  </form>
 </div>
 <br>
 
 <p class="text-primary" ng-if="elementos.length>0"> Mostrando  @{{elementos.length}} de @{{totalRegistros}} Registros</p>

<table class="table">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-primary" ng-model="ordenarPor" >
            Nombre y Apellidos            
            <a href="" ><i class="fa fa-arrow-down"  style="font-size:15px"  ng-click="ordenar('ordenarMenorAMayor')"></i></a>            
            <a href><i class="fa fa-arrow-up"  ng-hide="mostrar==1" style="font-size:15px"  ng-click="ordenar('ordenarMayorAMenor')"></i></a>
          </th>
            
            <th scope="col" class="text-primary">Barrio/Comunidad</th>
            <th scope="col" class="text-primary">Dirección</th>
            <th scope="col" class="text-primary">Teléfono</th>
            <th scope="col" class="text-primary">Estado</th>
                </tr>
            </thead>           

            <tbody>
          <tr ng-if="elementos.length<1"> <td colspan="6"><h3 class="text-success text-center">No hay Datos que Mostrar</h3></td></tr>
          
             <tr ng-repeat="(index, lis) in elementos| orderBy:ordenarPor">
              <th scope="row">@{{index +1}}</th>
              <td>@{{lis.nombreCompleto }} @{{lis.apellido}}</td>
              <td>@{{lis.nombreComunidad}}</td>
              <td>@{{lis.direccion}}</td>
              <td>@{{lis.telefono}}</td>
                                        
              <td ng-if="lis.estado==1"><span class="badge badge-success">Activo</span></td>
              <td ng-if="lis.estado==0"><span class="badge badge-danger">Inactivo</span></td>
              <td><a href="" ><i class="fa fa-pencil text-primary" ng-click="abrirModal('comunidad','actualizar',lis)" title="Editar"></i></a>
              <a href="" ng-click="eliminarCliente(lis)"><i class="fa fa-trash text-danger" title="Eliminar"></i></a>
                    
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
          <div >         
          </div>
          </div>
          <!--FIN DEL LISTADO-->
          @include('cliente.create')
         </div>
       
     <script src="{{ asset('/jquery/jquery-3.4.1.min.js')}}"></script>  
    <script src="{{ asset('/jquery/jquery.mask.min.js')}}"></script> 
    <script src="{{ asset('angularjs/angular.min.js')}}"></script>   
    <script src="{{ asset('js/cliente.js')}}"></script>   
    
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

<script>
jQuery(function ($) {
 $("#cedula").mask("000-000000-0000S");
});
</script>

@endsection
