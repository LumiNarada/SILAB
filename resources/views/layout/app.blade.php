<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SILAB</title>
    <link rel="stylesheet" href={{asset('assets/bootstrap/css/bootstrap.min.css')}}>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond:400,500,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Caslon+Text:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&amp;display=swap">
    <link rel="stylesheet" href={{asset('assets/css/Login-Form-Basic-icons.css')}}>
    <link rel="stylesheet" href={{asset('assets/css/styles.css')}}>
</head>

<body style="background: #faf8fb;">
@if(isset($administrador))
    <nav class="navbar navbar-expand-lg sticky-top bg-body" id="navbar-complete" style="background: #cd171e;">
        <div class="container-fluid" id="nav-container"><a class="navbar-brand" href="{{ route('muro') }}" style="background: #cd171e;color: #faf8fb;font-size: 38px;"><img class="logo" src={{asset('assets/img/UNAM.png')}}><img id="ing" class="logo" src={{asset('assets/img/FI.png')}} width="65" height="70" style="margin-right: 30px;"><strong>{{ __('SILAB') }}</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <p style="color: #faf8fb; margin:auto">{{$administrador->titulo}}. {{$administrador->nombre}} {{$administrador->apellidos}}</p>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav d-lg-flex ms-auto justify-content-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="#" style="color: #faf8fb;">Asignaturas</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #faf8fb;">Calificaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #faf8fb;">Estadísticas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('signup') }}" style="color: #faf8fb;" >Adminsitradores</a></li>
                    <li class="nav-item"><a class="nav-link" id="logout" href="{{ route('logout') }}"  style="color: #faf8fb;">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-md sticky-top bg-body" id="navbar-complete" style="background: #cd171e;">
        <div class="container-fluid" id="nav-container"><a class="navbar-brand" href="{{ route('login') }}" style="background: #cd171e;color: #faf8fb;font-size: 38px;"><img class="logo" src={{asset('assets/img/UNAM.png')}}><img id="ing" class="logo" src={{asset('assets/img/FI.png')}} width="65" height="70" style="margin-right: 30px;"><strong>{{ __('SILAB') }}</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav d-lg-flex ms-auto justify-content-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#" style="color: #faf8fb; margin-left: 5px; margin-right: 5px">Acerca De</a></li>
                    <li class="nav-item"><a class="nav-link" id="logout" href="{{ route('muro') }}" style="color: #faf8fb;">Lista de Asignaturas</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif
@yield('content')
<div class="clear"></div>
<footer class="text-center py-4" style="position: sticky;background: #cd171e;color: rgb(250,248,251);">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col">
                <p class="text-muted my-2" id="last-p">Todos los derechos reservados © 2006 - 2023 / Facultad de Ingeniería / UNAM</p>
            </div>
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item"></li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-inline my-2">
                    <li class="list-inline-item"><a class="link-secondary" href="#">Privacy Policy</a></li>
                    <li class="list-inline-item"><a class="link-secondary" href="#">Terms of Use</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src={{asset('assets/bootstrap/js/bootstrap.min.js')}}></script>
</body>
</html>
