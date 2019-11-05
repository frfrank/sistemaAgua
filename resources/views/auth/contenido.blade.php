<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
	<link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('alertify/css/alertify.min.css') }}">
	<link rel="stylesheet" href="{{ asset('alertify/css/themes/default.css') }}">  
</head>
<body>
    <div class="container">
        @yield('login')
    </div>

    <script src="{{ asset('/jquery/jquery-3.4.1.min.js')}}"></script>  
    <script src="{{ asset('/jquery/jquery.mask.min.js')}}"></script>      
    <script src="{{ asset('/alertify/alertify.min.js')}}"></script>
    <script src="{{ asset('/sweetalerta2/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('/plugins/js/bootstrap.min.js')}}"></script>

</body>
</html>