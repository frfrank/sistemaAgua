<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Default') | Panel de Administración</title>
    
	<link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('alertify/css/themes/default.css') }}">  
      
	
</head>
<body >
@if(Auth::check())
            @if (Auth::user()->idrol == 1)
                 @include('template.menu.menu')      
                
            @elseif (Auth::user()->idrol == 3)
            @include('template.menu.menuRecolector')      
            @else


            @endif

        @endif

    <div>
    
  
    
     @include('flash::message')
	<div class="container" style="background:#E9ECEF">
	    @yield('content')
	</div>
    <br>
    @yield('seccion')   
    </div>    
 
    <!--<footer class="fixed-bottom footer">    
    <p>Sistema Laravel</p></footer>  -->

    <script src="{{ asset('/jquery/jquery-3.4.1.min.js')}}"></script>  
    <script src="{{ asset('/jquery/jquery.mask.min.js')}}"></script>      
    <script src="{{ asset('/alertify/alertify.min.js')}}"></script>
    <script src="{{ asset('/sweetalerta2/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('/plugins/js/bootstrap.min.js')}}"></script>


</body>
</html>