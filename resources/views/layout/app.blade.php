<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SILAB</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-dark navbar-expand-lg fixed-top portfolio-navbar">
            <div class="container" style="justify-content: space-around">
                <img src="images/logo-unam-png-blanco-ok.png" alt="logo unam" height="50px">
                <a class="nav-link" href="{{ route('muro') }}"> <h1> {{ __('SILAB') }} </h1>  </a>
                <img src="images/UNAM_INGENIERIA-logo-38271A0B79-seeklogo.com.png" alt="logo ingenieria" height="50px">
            </div>
        </nav>
        <div class="container" style="margin-top: 75px;">
            @yield('content')
        </div>
        <nav class="navbar fixed-bottom">
            <div class="container-fluid">
                <h10>Todos los derechos reservados 1999-2023/ Facultad de Ingeniería / UNAM</h10>
            </div>
        </nav>
    </body>
</html>
