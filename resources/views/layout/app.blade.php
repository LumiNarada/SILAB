<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SILAB</title>
    <link rel="stylesheet" href={{asset('assets/bootstrap/css/bootstrap.min.css')}}>
    <link rel="icon" href={{asset('../images/logo-fi-rojo.png')}}>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond:400,500,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Caslon+Text:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;display=swap">
    <link rel="stylesheet" href={{asset('assets/css/Login-Form-Basic-icons.css')}}>
    <link rel="stylesheet" href={{asset('assets/css/styles.css')}}>
</head>

<body style="font-family: Roboto; background: #faf8fb; display: flex; flex-direction: column; min-height: 100vh !important">
@if(isset($administrador))
    <nav class="navbar navbar-expand-lg sticky-top bg-body" id="navbar-complete" style="background: #cd171e;">
        <div class="container-fluid" id="nav-container"><a class="navbar-brand" id="navbarcito" style="background: #cd171e;color: #faf8fb;font-size: 38px;"><img class="logo" src={{asset('assets/img/UNAM.png')}}><img id="ing" class="logo" src={{asset('assets/img/FI.png')}} width="65" height="70" style="margin-right: 30px;"><strong id="silabnavbar">{{ __('SILAB') }}</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <p style="color: #faf8fb; margin:auto">{{$administrador->nombre}} {{$administrador->apellidos}}</p>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav d-lg-flex ms-auto justify-content-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('muro') }}" style="color: #faf8fb;">Asignaturas</a></li>
                    <li class="nav-item"></li>
                    <!--
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #faf8fb;">Calificaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #faf8fb;">Estadísticas</a></li>
                    -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('signup') }}" style="color: #faf8fb;" >Adminsitradores</a></li>
                    <li class="nav-item"><a class="nav-link" id="logout" href="{{ route('logout') }}"  style="color: #faf8fb;">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-lg sticky-top bg-body" id="navbar-complete" style="background: #cd171e;">
        <div class="container-fluid" id="nav-container"><a class="navbar-brand" id="navbarcito" style="background: #cd171e;color: #faf8fb;font-size: 38px;"><img class="logo" src={{asset('assets/img/UNAM.png')}}><img id="ing" class="logo" src={{asset('assets/img/FI.png')}} width="65" height="70" style="margin-right: 30px;"><strong id="silabnavbar">{{ __('SILAB') }}</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <p id="titulo-silab" style="color: #faf8fb; margin:auto; font-size: x-small">Ssistema de inscripción para prácticas optativas de las asignaturas de Matemáticas y de Ciencias Aplicadas <br> de la División de Ciencias Básicas de la Facultad de Ingeniería de la UNAM.</p>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav d-lg-flex ms-auto justify-content-lg-center">
                    <li class="nav-item"><a class="nav-link" href="https://dcb.ingenieria.unam.mx" style="color: #faf8fb; margin-left: 5px; margin-right: 5px">División de Ciencias Básicas</a></li>
                    <li class="nav-item"><a class="nav-link" id="logout" href="{{ route('muro') }}" style="color: #faf8fb;">Lista de Asignaturas</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif
@yield('content')
@if(isset($none))
@else
<div class="clear"></div>
<footer class="text-center py-4" style="background: #cd171e;color: rgb(250,248,251); margin-top: auto !important">
    <div class="container">
        <div class="row row-cols-2 row-cols-lg-2">
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item">Universidad Nacional Autónoma de México</li>
                </ul>
                <ul class="list-inline my-2">
                    <li class="list-inline-item" style="font-size: small">Facultad de Ingeniería, Av. Universidad 3000, Ciudad Universitaria, Coyoacán, CDMX. CP. 04510</li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item"> Todos los derechos reservados © 2024 - {{$year}} </li>
                </ul>
                <ul class="list-inline my-2">
                    <li class="list-inline-item" style="font-size: small">  <a href="https://www.ingenieria.unam.mx/" style="color: rgb(250, 248, 251); text-decoration: none"> Facultad de Ingeniería </a> / <a href="https://www.unam.mx/" style="color: rgb(250, 248, 251); text-decoration: none"> UNAM </a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item" style="font-size: xx-small">Este es el sitio web del Sistema de inscripción para prácticas optativas de asignaturas de Matemáticas y de Ciencias Aplicadas de la División de Ciencias Básicas de la Facultad de Ingeniería de la UNAM. Puede ser reproducido con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica. La elaboración de este sitio web fue llevada a cabo por Damián Magaña Raúl de Jesús y Alfaro Domínguez Arturo.</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@endif
<script src={{asset('assets/bootstrap/js/bootstrap.min.js')}}></script>
<script>
    $(document).ready(function(){
        $("#silabnavbar").dblclick(function(){

            console.log('a');
            window.location.href = "{{ route('login') }}";
        });
    });
    console.log('a');
</script>
</body>
</html>
