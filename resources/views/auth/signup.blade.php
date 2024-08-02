@extends('layout.app')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert" style="width: 60%; margin: auto; text-align: center; margin-top: 7px">{{Session::get('success')}}</div>
    @endif
    @if(isset($administradores))
            <div style="background-color: #FAF8FB; padding: 20px 20px 15px 20px; margin: 10px 50px 10px 50px" class="SesionWhite">
                <h5><strong>Lista de Administradores</strong></h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($administradores as $admin)
                    <tr>
                        <td>{{$admin->usuario}}</td>
                        <td>{{$admin->nombre}}</td>
                        <td>{{$admin->apellidos}}</td>
                        <td style="width: 350px;">
                            <div style="display: flex; justify-content: space-around">
                            <form method="get" action="{{route('modifyAdministrator', $admin->id)}}">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm" style="width: 150px;  margin: auto">Modificar Datos</button>
                                <input type="hidden" name="id" value="{{$admin->id}}">
                            </form>
                            @if($count>1)
                                <form method="post" action="{{route('destructionAdministrator')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$admin->id}}">
                                    <button type="submit" class="btn btn-dark btn-sm" style="width: 150px;  margin: auto">Eliminar registro</button>
                                </form>
                            @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

    @endif
    <section class="position-relative py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Registro de Nuevo Administrador</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background: #cd171e;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                                </svg></div>
                            <form class="text-center" action="{{route('registration')}}" method="post">
                                @if(Session::has('success'))
                                    <div class="alert alert-succes">{{Session::get('success')}}</div>
                                @endif
                                @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                @endif
                                @csrf
                                <div class="mb-3"><input class="form-control" type="text" name="usuario" placeholder="Usuario" value="{{old('usuario')}}" autocomplete="off"><span class="text-danger">@error('usuario'){{$message}}@enderror</span></div>
                                <div class="mb-3"><input class="form-control" type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}" autocomplete="off"><span class="text-danger">@error('nombre'){{$message}}@enderror</span></div>
                                <div class="mb-3"><input class="form-control" type="text" name="apellidos" placeholder="Apellidos" value="{{old('apellidos')}}" autocomplete="off"><span class="text-danger">@error('apellidos'){{$message}}@enderror</span></div>
                                <div class="mb-3"><input class="form-control" type="password" name="contrasena"  placeholder="Contraseña" ><span class="text-danger">@error('contrasena'){{$message}}@enderror</span></div>
                                <div class="mb-3"><input class="form-control" type="password" name="contrasena_confirmation"  placeholder="Confirme contraseña" ><span class="text-danger">@error('contrasena_confirmation'){{$message}}@enderror</span></div>
                                <div class="mb-3"><p style="font-size: 16px">Todos los campos son obligatorios. <br> La contraseña debe tener una longitud de 6 a 20 caracteres e incluir caracteres y números.</p></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: #cd171e;">Registrar</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

