@extends('layout.app')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form style="padding: 30px" method="post" action="{{route('modifyPractice')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">N° de Práctica</label>
                            <input type="number" class="form-control" name="orden" value="{{$practica->orden}}">
                            <span class="text-danger">@error('orden'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputPassword4">Asignatura</label>
                            <select name="asignatura" id="asignatura" class="form-control">
                                @foreach($asignaturas as $asignatura)
                                    <option value="{{$asignatura->id}}" @if ($practica->asignatura_id == $asignatura->id) selected @endif  >{{$asignatura->nombre}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('asignatura'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{$practica->nombre}}" autocomplete="off">
                            <span class="text-danger">@error('nombre'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Indicaciones</label>
                            <input type="text" class="form-control" name="indicaciones" value="{{$practica->indicaciones}}">
                            <span class="text-danger">@error('indicaciones'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row" style="margin-left: 1px; margin-top: 7px">
                        <div class="form-group col-md-6">
                            <label class="custom-file-label" for="customFile">Cuestionario Previo</label>
                            <input type="file" class="custom-file-input" name="previo">
                            <span class="text-danger">@error('previo'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row" style="margin-left: 1px; margin-top: 7px">
                        <div class="form-group col-md-6">
                            <label class="custom-file-label" for="customFile">Manual</label>
                            <input type="file" class="custom-file-input" name="manual">
                            <span class="text-danger">@error('manual'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$practica->id}}">
                    <button type="submit" class="btn btn-primary" style="margin-top: 7px">Enviar</button>
                </form>
            </div>
        </div>
    </div>


    <div class="d-lg-flex justify-content-lg-center" style="text-align: center; display: flex; flex-direction: column" >
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert" style="width: 60%; margin: auto; text-align: center; margin-top: 7px">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
            <h2 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb; padding: 5px"><strong>{{$asignatura->clave}} {{$asignatura->nombre}}</strong></h2>
            <div class="col-md-10 text-center mx-auto">
                <h1>Práctica {{$practica->orden}}. {{$practica->nombre}}</h1>
                <p style="text-align: left">{{$practica->indicaciones}} </p>
                    <div style="display: flex; flex-direction: row; margin: 10px">
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-primary btn-sm" style=" width: 230px"><a style=" text-decoration:none; color: white;" href={{ route('descargar', ['id_pdf' => $practica->manual]) }}> Descargar manual </a></button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-primary btn-sm" style=" width: 230px"><a style=" text-decoration:none; color: white" href={{ route('descargar', ['id_pdf' => $practica->previo]) }}> Descargar cuestionario previo </a></button>
                        </div>
                    </div>
                        @if(isset($administrador))
                    <div style="display: flex; flex-direction: row; margin: 10px">
                            <div class="form-group col-md-4">
                                <button type="button" class="btn btn-success btn-sm" style="width: 200px"> <a style=" text-decoration:none; color: white" href={{ route('calificaciones', ['id_calificaciones' => $practica->id]) }}> Archivo de calificaciones </a></button>
                            </div>
                            <div class="form-group col-md-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalCenter" style="width: 200px">Editar Práctica</button>
                            </div>
                            <div class="form-group col-md-4">
                                <form action="{{ route('deletePractice', ['id_practica' => $practica->id]) }}" method="post" style="display:flex; flex-direction: row">
                                    @csrf
                                        <button type="submit" class="btn btn-info btn-sm" style="width: 200px">Eliminar Práctica</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    @if(isset($administrador))
                        <form method="post" action="{{route('addSession')}}">
                            @csrf
                            <div class="row" >
                                <div class="form-group col-md-3"  style="margin-top: 30px">
                                    <label>Nueva Sesión: &nbsp;</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <input type="datetime-local" class="form-control" id="datetime" name="datetime">
                                    <span class="text-danger">@error('orden'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="hidden" id="practica_id" name="practica_id" value="{{$practica->id}}">
                                    <button type="submit" class="btn btn-primary btn-sm"  style="margin: 7px; width: 170px" >Agregar Sesión</button>
                                </div>
                            </div>
                        </form>
                        @foreach($sesiones as $sesion)
                            <p style="display: none">{{$num=1}}</p>
                            <h5 style="margin-top: 30px">Lista de asistencia </h5>
                            <h5 style="margin-top: 7px">Fecha: {{$sesion->fechaDia[2]}}-{{$sesion->fechaDia[1]}}-{{$sesion->fechaDia[0]}} &nbsp; &nbsp; Hora: {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} hrs. </h5> <hr>
                            <form method="post" action="{{ route('changeScore') }}" >
                            @csrf
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Número de Cuenta</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Calificación</th>
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach ($alumnos as $alumno)
                                            @if($alumno->sesion_id == $sesion->id)
                                                <tr>
                                                    <th scope="row">{{ $num++, $num}}</th>
                                                    <td>{{$alumno->numeroCuenta}}</td>
                                                    <td>{{$alumno->apellidos}}</td>
                                                    <td>{{$alumno->nombre}}</td>
                                                    <td>
                                                        <div class="form-group" style="width: 40%; margin:auto">
                                                            <input type="number" class="form-control" name="{{$alumno->id}}" placeholder="{{$alumno->calificacion}}" autocomplete="off">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                </tbody>
                            </table>
                            <div class="form-group col-md-3" style="margin-left: auto; margin-right: auto">
                                <button type="submit" class="btn btn-primary"  style="margin: 7px; width: 170px" >Guardar Cambios</button>
                            </div>
                        </form>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @if(isset($administrador))
    @else
        <div class="d-lg-flex justify-content-lg-center" style="text-align: center" >
            <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
                <div>
                    <form style="padding: 30px" method="post" action="{{route('storageAlumno')}}" >
                        @if(isset($success))
                            <div class="alert alert-succes">{{Session::get('success')}}</div>
                        @endif
                            @if(isset($fail))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <h1>Inscribirme</h1> <hr>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>N° de Práctica</label>
                                <input type="number" class="form-control" name="orden" placeholder="{{$practica->orden}}" value="{{$practica->orden}}" readonly disabled>
                            </div>
                            <div class="form-group col-md-9">
                                <label>Nombre de la Practica</label>
                                <select name="practica_id" id="practica_id" class="form-control" readonly disabled>
                                    <option value="{{$practica->id}}" readonly>{{$practica->nombre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 7px">
                            <div class="form-group col-md-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" autocomplete="off">
                                <span class="text-danger">@error('nombre'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" autocomplete="off">
                                <span class="text-danger">@error('apellidos'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 7px">
                            <div class="form-group col-md-3">
                                <label>Número de cuenta</label>
                                <input type="number" class="form-control" name="cuenta" placeholder="#########" autocomplete="off">
                                <span class="text-danger">@error('cuenta'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Grupo Teórico</label>
                                <input type="number" class="form-control" name="grupo" placeholder="#" autocomplete="off">
                                <span class="text-danger">@error('grupo'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Sesión</label>
                                <select name="sesion" class="form-select">
                                    @foreach($sesiones as $sesion)
                                        <option value={{$sesion->id}}> Fecha: {{$sesion->fechaDia[2]}}-{{$sesion->fechaDia[1]}}-{{$sesion->fechaDia[0]}} &nbsp; &nbsp; &nbsp; Hora: {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} hrs. </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="practica_id" value="{{$practica->id}}">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 7px">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
