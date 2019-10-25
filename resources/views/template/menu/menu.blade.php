
<link rel="stylesheet" href="{{ asset('plugins/css/font-awesome.min.css') }}"/>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" style="color:white" href="#">Sistema Saausn</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active text-success">
        <a class="nav-link" style="color:white" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" style="color:white" data-toggle="dropdown" href="#"  aria-haspopup="true" aria-expanded="false">Atención Clientes</a>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('indexCliente')}}"><i class="fa fa-list"></i> Lista de Clientes</a>
        <a class="dropdown-item" href="{{route('crearcliente')}}"><i class="fa fa-plus"></i> Nuevo Cliente</a>
        <a class="dropdown-item" href=""><i class="fa fa-plus"></i> Nueva Solicitud Servicio</a>
        <a class="dropdown-item" href=""><i class="fa fa-list"></i> Estado de Cuentas</a>

      </div>
    </li>
        <li class="nav-item">
        <a class="nav-link" style="color:white" href="#">Categorias</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" style="color:white" href="#">Imágenes</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" style="color:white" href="#">Tags</a>
      </li>
     <li class="nav-item">
        <a class="nav-link text-left" style="color:white" href="#">Clientes</a>
        <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" style="color:white" data-toggle="dropdown" href="#"  aria-haspopup="true" aria-expanded="false">Catálogos</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('cargo')}}"><i class="fa fa-list"></i> Cargos</a>
        <a class="dropdown-item" href="{{route('servicio')}}"><i class="fa fa-list"></i> Servicios</a>
        <a class="dropdown-item" href="{{route('indexComunidad')}}"><i class="fa fa-list"></i> Comunidades</a>
        <a class="dropdown-item" href="{{route('indexRoles')}}"><i class="fa fa-list"></i> Roles</a>

        <div role="separator" class="dropdown-divider"></div>
        <a class="dropdown-item" href="#three">three</a>
      </div>
    </li>

      <li>
    </ul>
   <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>



