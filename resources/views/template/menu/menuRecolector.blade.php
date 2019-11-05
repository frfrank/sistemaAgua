
    @if(Auth::check())
            @if (Auth::user()->idrol == 3)
<div>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" style="color:white; margin-left:8%" href="{{route('inicio')}}">Sistema Saausn</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      
     <li class="nav-item">
        <a class="nav-link text-left" style="color:white" href="#">Clientes</a>
        <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" style="color:white" data-toggle="dropdown" href="#"  aria-haspopup="true" aria-expanded="false">Catálogos</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{route('cargo')}}"><i class="fa fa-list"></i> Cargos</a>
        <a class="dropdown-item" href="{{route('servicio')}}"><i class="fa fa-list"></i> Servicios</a>

      </div>
    </li>    
    </ul>
    

  <!--  <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
    <div style="color:white;margin-right:8%;" class="my-2 my-lg-0">
   <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" 
  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-user"></i>  
  <span class="d-md-down-none">{{Auth::user()->nombreUsuario}} </span>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href=""><i class="fa fa-user"></i> Perfil</a>
        <a class="dropdown-item" href=""><i class="fa fa-tasks"></i> Configuración</a>
        <a class="dropdown-item" href="{{route('vistaUsuarios')}}"><i class="fa fa-shield"></i> Seguridad</a>
        <a class="dropdown-item" href=""><i class="fa fa-building-o"></i> Plan de Trabajo</a>
        <a class="dropdown-item" href="{{route('logout')}}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off"></i> Cerrar Sesión</a>
       
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
        </div>
</div>
  
    </div>
  </div>
</nav>

</div>
@endif

@endif