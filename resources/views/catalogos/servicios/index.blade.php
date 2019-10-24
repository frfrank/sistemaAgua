@extends('template.principal')
@section('seccion')
<div class="container">

<h1 class="text-success">Lista de Servicios</h1>
<div class="row">
<div class="col-md-2">
<a href="{{route('crearcargo')}}" class="btn btn-success">Nuevo</a>
</div>
</div><br>
@include('catalogos.servicios.search')

<!--Tabla para listar los servicios-->
<table class="table table-striped table-responsive" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
      <th scope="col">Estado</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
  @foreach($servicio as $elemento=>$item)
    <tr>
      <th scope="row" style="width:10%">{{$elemento+1}} </th>
      <td style="width:20%">{{$item->nombre}}</td>
      <td style="width:45%">{{$item->descripcion}}</td>
      <td style="width:10%">{{$item->precioServicio}}</td>
      @if($item->estado==1)
      <td style="width:10%"><span class="badge badge-success">ACTIVO</span>
  </td>
      @else
      <td style="width:10%"><span class="badge badge-danger">INACTIVO</span>
  </td>
      @endif
      <td>
      <a href="{{route('editarServicio',$item->id)}}" ><i class="fa fa-pencil text-primary"></i></a>
      <a href="{{route('eliminar',$item->id)}}" data-target="#modal-delete" data-toggle="modal"><i class="fa fa-trash text-danger"></i></a>
      </td>
    @endforeach

    </tr>
    
  </tbody>
</table>
  
@include('catalogos.servicios.modal')
{{$servicio->render()}}
<br><br>
</div>
@endsection