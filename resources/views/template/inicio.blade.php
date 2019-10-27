@extends('template.principal')
@section('seccion')

<div class="container">
<br>
<div class=row>
<div class="col-md-3 col-sm-12 col-xs-12">
<a href="{{route('indexCliente')}}">
<div class="card " style="width: 16rem; background:#F5B400; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Clientes</h4>
    <hr>
        <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-users"></i></h1>    
  </div>
</div>
</a>
 <br>
</div>

<div class="col-md-4 col-sm-12 col-xs-12">
<div class="card " style="width: 22rem; background:#556370; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Contratos</h4>
    <hr>
        <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-file"></i></h1>    
  </div>
</div><br>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
<div class="card " style="width: 22rem; background:#E44B1F; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Caja</h4>
    <hr>
    <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-money"></i></h1>    
  </div>
</div>
</div><br>
</div>
<br>
<div class="row">
<div class="col-md-4 col-sm-12 col-xs-12">
<div class="card " style="width: 22rem; background:#8845AC; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Estadisticas</h4>
    <hr>
    <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-signal"></i></h1>    
  </div>
</div><br>
</div>
<div class="col-md-4 col-sm-12 col-xs-12">
<div class="card " style="width: 22rem; background:#3680D2; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Servicio de Agua</h4>
    <hr>
        <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-tint"></i></h1>    
  </div>
</div><br>
</div>
<div class="col-md-3 col-sm-12 col-xs-12">
<div class="card " style="width: 16rem; background:#53606D; color:white;">
  <div class="card-body clientes">
    <h4 class="card-title text-center">Arreglos de Pagos</h4>
    <hr>
        <h1 class="text-center" style="font-size: 120px;"><i class="fa fa-usd"></i></h1>    
  </div>
</div>
</div>
</div>
</div>
<br><br>
@endsection