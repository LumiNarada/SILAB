@extends('layout.app')
@section('content')
<section class="position-relative py-4 py-xl-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Inicio de Sesión</h2>
                <p id="login-p" class="w-lg-50">Si eres un alumno, no es necesario que inicies sesión para registrarte en alguna práctica, puedes hacerlo directamente ingresando tus datos en alguna de las sesiones de la <a href="{{route('muro')}}">lista</a>&nbsp;de prácticas.</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-5">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background: #cd171e;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                            </svg></div>
                        <form class="text-center" action="{{route('checkLogIn')}}" method="post">
                            @if(Session::has('success'))
                                <div class="alert alert-succes">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @csrf
                            <div class="mb-3"><input class="form-control" type="text" name="usuario" placeholder="Usuario" value="{{old('usuario')}}" autocomplete="off"></div>
                            <div class="mb-3"><input class="form-control" type="password" name="contrasena"  placeholder="Contraseña" value="{{old('cuenta')}}"></div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: #cd171e;">Acceder</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
