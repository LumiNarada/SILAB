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
                                @foreach($asignaturas as $asign)
                                    <option value="{{$asign->id}}" @if ($practica->asignatura_id == $asign->id) selected @endif > {{$asignatura->nombre}} </option>
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
                            <label class="custom-file-label" for="customFile">Manual</label> <br>
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
            <div class="alert alert-danger" style="width: 60%; margin: auto; text-align: center; margin-top: 7px">{{Session::get('fail')}}</div>
        @endif
        @if($errors->isEmpty()==False)
            <div class="alert alert-danger" style="width: 60%; margin: auto; text-align: center; margin-top: 7px">Datos incorrectos </div>
        @endif
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
            <h2 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb; padding: 5px"><strong>{{$asignatura->clave}} {{$asignatura->nombre}} </strong></h2>
            <div class="col-md-10 text-center mx-auto">
                <h1>Práctica {{$practica->orden}}. {{$practica->nombre}}</h1>
                <div style="background-color: #bdbdbd; padding: 10px" class="indicaciones">
                    <p style="text-align: left; margin:0px">{{$practica->indicaciones}} </p>
                </div>

                    <div style="display: flex; flex-direction: row; margin: 10px" class="inscriptionButtons">
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-primary btn-sm inscriptionButton" style=" width: 230px"><a style=" text-decoration:none; color: white" href={{ route('descargar', ['id_asignatura' => explode('/',$practica->previo)[1], 'id_pdf' => explode('/',$practica->previo)[2]]) }}> Descargar cuestionario previo </a></button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-primary btn-sm inscriptionButton" style=" width: 230px"><a style=" text-decoration:none; color: white;" href={{ route('descargar', ['id_asignatura' => explode('/',$practica->manual)[1], 'id_pdf' => explode('/',$practica->manual)[2]]) }}> Descargar manual </a></button>
                        </div>
                    </div>
                        @if(isset($administrador))
                    <div style="display: flex; flex-direction: row; margin: 10px" class="materiaColumna1">
                            <div class="form-group col-md-4 botónMateria">
                                <button type="button" class="btn btn-success btn-sm" style="width: 200px"> <a style=" text-decoration:none; color: white" href={{ route('calificaciones', ['id_calificaciones' => $practica->id]) }}> Archivo de calificaciones </a></button>
                            </div>
                            <div class="form-group col-md-4 botónMateria">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModalCenter" style="width: 200px">Editar Práctica</button>
                            </div>
                            <div class="form-group col-md-4 botónMateria">
                                <form action="{{ route('deletePractice', ['id_practica' => $practica->id]) }}" method="post" style="display:flex; flex-direction: row" class="formMateria">
                                    @csrf
                                        <button type="submit" class="btn btn-dark btn-sm botonEl" style="width: 200px">Eliminar Práctica</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    @if(isset($administrador))

                        <div class="blockPractica">
                            <hr>
                            <h4 style="text-align: start">&nbsp;Añadir una nueva sesión</h4>
                            <div style="display: flex; flex-direction: row; ">
                                <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> <p style="font-size: small; color: #cd171e; margin: 0px">Campo obligatorio</p>
                            </div>
                            <form method="post" id="formAddSession" action="{{route('addSession')}}" style="margin: auto; width: 100%; margin-bottom: 30px">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-5" style="text-align: start">
                                        <label style="display: flex; flex-direction: row">&nbsp; Fecha y hora: <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" value="{{$myTime}}">
                                        <span class="text-danger">@error('datetime'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group col-md-4" style="text-align: start">
                                        <label style="display: flex; flex-direction: row">&nbsp; Duración: <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                        <input type="time" class="form-control" id="time" name="time" value="02:00">
                                        <span class="text-danger">@error('time'){{$message}}@enderror</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2" style="text-align: start">
                                        <label style="display: flex; flex-direction: row">&nbsp; Aula:  <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                        <input type="text" class="form-control" id="time" name="aula" value="H0-01">
                                        <span class="text-danger">@error('aula'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group col-md-2" style="text-align: start">
                                        <label style="display: flex; flex-direction: row">&nbsp; Cupo:  <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                        <input type="number" class="form-control" id="time" name="cupo" value="20">
                                        <span class="text-danger">@error('cupo'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group col-md-5" style="text-align: start">
                                        <label style="">&nbsp; Profesor(a): </label>
                                        <input type="text" class="form-control" id="time" name="profesor" value="Evelyn Salazar Guerrero">
                                        <span class="text-danger">@error('profesor'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input type="hidden" id="practica_id" name="practica_id" value="{{$practica->id}}">
                                        <button type="submit" id="submitAddSesion" class="btn btn-success btn-sm botonGreen"  style="margin: 7px; width: 130px; position: relative; bottom: 25px" >Agregar<br>Sesión</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                document.getElementById("formAddSession").addEventListener("submit", function(event) {
                                    event.preventDefault(); // Evita el envío múltiple inmediato
                                    let boton = document.getElementById("submitAddSesion");

                                    if (boton.disabled) return; // Si ya está deshabilitado, no hace nada

                                    boton.disabled = true; // Desactiva el botón
                                    this.submit(); // Envía el formulario manualmente
                                });
                            </script>

                        </div>
                    @endif
                </div>
            </div>
            @if(isset($administrador))
                @foreach($sesiones as $sesion)
                    <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
                        <div style="padding: 30px">
                            <div class="blockPractica" >
                                <p style="display: none">{{$num=1}}</p>
                                <h4 style="margin-top: 30px; text-align: center ">Lista de Asistencia</h4>
                                <div style="display: flex; justify-content: center">
                                    <p style="margin-right: 10px"><strong>Fecha:</strong> {{$sesion->fechaDia[2]}} de {{convertMonth($sesion->fechaDia[1])}}, {{$sesion->fechaDia[0]}}</p>
                                    <p style="margin-left: 5px"><strong>Horario:</strong> {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} - {{$sesion->fechaHora[0]+$sesion->duracionExplode[0]}}:@if($sesion->fechaHora[1]+$sesion->duracionExplode[1]<10)0{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @else{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @endif hrs.</p>
                                </div>
                                <hr>
                                <form method="post" action="{{route('modifySession')}}" style="margin: auto; width: 100%; margin-bottom: 30px">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-5" style="text-align: start">
                                            <label style="display: flex; flex-direction: row">&nbsp; Fecha y hora: <p style="font-size: large; color: #0c0606; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                            <input type="datetime-local" class="form-control" id="datetime" name="datetime" value="{{$sesion->fecha}}">
                                            <span class="text-danger">@error('datetime'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-md-4" style="text-align: start">
                                            <label style="display: flex; flex-direction: row">&nbsp; Duración: <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                            <input type="time" class="form-control" id="time" name="time" value="{{$sesion->duracion}}">
                                            <span class="text-danger">@error('time'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="hidden" id="practica_id" name="practica_id" value="{{$practica->id}}">
                                            <input type="hidden" id="sesion_id" name="sesion_id" value="{{$sesion->id}}">
                                            <button type="submit" class="btn btn-info btn-sm"  style="margin: 7px; width: 130px; position: relative" >Modificar<br>Sesión</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2" style="text-align: start">
                                            <label style="display: flex; flex-direction: row">&nbsp; Aula: <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                            <input type="text" class="form-control" id="time" name="aula" value="{{$sesion->aula}}">
                                            <span class="text-danger">@error('aula'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-md-2" style="text-align: start">
                                            <label style="display: flex; flex-direction: row">&nbsp; Cupo: <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; * &nbsp;</p> </label>
                                            <input type="number" class="form-control" id="time" name="cupo" value="{{$sesion->cupo}}">
                                            <span class="text-danger">@error('cupo'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-md-5" style="text-align: start">
                                            <label style="">&nbsp; Profesor(a): </label>
                                            <input type="text" class="form-control" id="time" name="profesor" value="{{$sesion->profesor}}">
                                            <span class="text-danger">@error('profesor'){{$message}}@enderror</span>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <a href="{{route('deleteSession', $sesion->id)}}" class="btn btn-dark btn-sm"  style="margin: 7px; width: 130px">Eliminar<br>Sesión</a>
                                        </div>
                                    </div>
                                </form>



                                <form method="post" action="{{ route('changeScore') }}" >
                                    @csrf
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">N. de Cuenta</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Previo</th>
                                            <th scope="col">Práctica</th>
                                            <th scope="col">Dar de Baja</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($alumnos as $alumno)
                                            @if($alumno->sesion_id == $sesion->id)
                                                <tr>
                                                    <th scope="row">{{ $num++, $num}}</th>
                                                    <td style="width: 12%;">{{$alumno->numeroCuenta}}</td>
                                                    <td style="width: 23%; padding-left: 15px; padding-right: 15px; text-align: start">{{$alumno->apellidos}}</td>
                                                    <td style="width: 23%; padding-left: 15px; padding-right: 15px; text-align: start">{{$alumno->nombre}}</td>
                                                    <td>
                                                        <div class="form-group" style="width: 50px; margin:auto">
                                                            <input type="number" class="form-control" name="previo_{{$alumno->id}}" value="{{$alumno->calificacionPrevio}}" autocomplete="off">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" style="width: 50px; margin:auto">
                                                            <input type="number" class="form-control" name="practica_{{$alumno->id}}" value="{{$alumno->calificacionPractica}}" autocomplete="off">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group col-md-3">
                                                            <a href="{{route('deleteAlumn', $alumno->id)}}" class="btn btn-dark btn-sm"  style="margin: 7px; width: 70px">Eliminar</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-3" style="margin-left: auto; margin-right: auto">
                                        <button type="submit" class="btn btn-success"  style="margin: 7px; width: 170px" >Guardar Lista</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
           @endif
        </div>
    @if(isset($administrador))
    @else
        <div class="d-lg-flex justify-content-lg-center" style="text-align: center" >
            <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
                <div style="padding: 30px">
                    <h1>Sesiones</h1> <hr>
                            @foreach($sesiones as $sesion)
                                <div style="background-color: #FAF8FB; padding: 20px 20px 15px 20px; margin: 10px 50px 10px 50px" class="SesionWhite">
                                    <h5><strong>Sesión {{ $num++, $num}}</strong></h5>
                                    <div style="margin: 0px 10px; display: flex; flex-wrap: wrap; flex-direction: column; margin: 1px">
                                        <div style="display: flex; flex-direction: row; justify-content: start; margin: 0px" class="sesionContainer">
                                            <p class="sesionP"><strong>Fecha:</strong> {{$sesion->fechaDia[2]}} de {{convertMonth($sesion->fechaDia[1])}} {{$sesion->fechaDia[0]}}</p>
                                            <p class="sesionP"><strong>Horario:</strong> {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} - {{$sesion->fechaHora[0]+$sesion->duracionExplode[0]}}:@if($sesion->fechaHora[1]+$sesion->duracionExplode[1]<10)0{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @else{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @endif hrs.</p>
                                            <p class="sesionP"><strong>Salón:</strong> {{$sesion->aula}}</p>
                                        </div>
                                        <div style="display: flex; flex-direction: row; justify-content: start; margin: 0px" class="sesionContainer">
                                            <p class="sesionP"><strong>Vacantes: </strong>{{$sesion->cupo - $sesion->vacantes}} de {{$sesion->cupo}}@if($sesion->vacantes<10)&nbsp;@endif</p>
                                            @if($sesion->profesor)<p class="sesionP"><strong>Profesor(a):</strong> {{$sesion->profesor}}</p>@endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                </div>
            </div>
        </div>

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
                        <div style="display: flex; flex-direction: row; ">
                            <p style="font-size: large; color: #cd171e; margin: 0px;">* &nbsp;</p> <p style="font-size: small; color: #cd171e; margin: 0px">Campo obligatorio</p>
                        </div>
                        <div class="row" style="margin-top: 7px">
                            <div class="form-group col-md-5">
                                <label  style="display:flex; flex-direction: row">Nombre  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre" autocomplete="off" value="{{old('nombre')}}">
                                <span class="text-danger">@error('nombre'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-5">
                                <label style="display:flex; flex-direction: row">Apellidos  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" autocomplete="off" value="{{old('apellidos')}}">
                                <span class="text-danger">@error('apellidos'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-2">
                                <label style="display:flex; flex-direction: row">Grupo Teórico  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <input type="number" class="form-control" name="grupo" placeholder="#" autocomplete="off" value="{{old('grupo')}}">
                                <span class="text-danger">@error('grupo'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 7px">
                            <div class="form-group col-md-2">
                                <label style="display:flex; flex-direction: row">Número de Cuenta  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <input type="number" class="form-control" name="cuenta" placeholder="#########" autocomplete="off" value="{{old('cuenta')}}">
                                <span class="text-danger">@error('cuenta'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-5">
                                <label style="display:flex; flex-direction: row">Carrera  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <select name="carrera" class="form-select">
                                    <option hidden selected> </option>
                                    @foreach($carreras as $carrera)
                                        <option value={{$carrera->id}} {{ old('carrera') == $carrera->id ? 'selected' : '' }}> {{$carrera->nombre}} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('carrera'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group col-md-5">
                                <label style="display:flex; flex-direction: row">Sesión  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <select name="sesion" class="form-select">
                                    <option hidden selected> </option>
                                    @foreach($sesiones as $sesion)
                                        @if($sesion->vacantes < $sesion->cupo)
                                            <option value={{$sesion->id}} {{ old('sesion') == $sesion->id ? 'selected' : '' }} >{{$otroNum}}. Fecha: {{$sesion->fechaDia[2]}}-{{$sesion->fechaDia[1]}}-{{$sesion->fechaDia[0]}} &nbsp; Horario: {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} - {{$sesion->fechaHora[0]+$sesion->duracionExplode[0]}}:@if($sesion->fechaHora[1]+$sesion->duracionExplode[1]<10)0{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @else{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @endif hrs. </option>
                                        @endif
                                            {{$otroNum++}}
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('sesion'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 7px">
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="aviso" {{ old('aviso') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault"  style="display: flex; flex-direction: row">
                                        He leído y estoy de acuerdo con el&nbsp;<a href="https://www.ingenieria.unam.mx/paginas/aviso_privacidad.php" style="color:#2E86C1;">Aviso de privacidad de la Facultad de Ingeniería</a> <p style="font-size: large; color: #cd171e; margin: 0px;">&nbsp; *</p>
                                    </label>
                                    <span class="text-danger">@error('aviso'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <input type="hidden" name="orden" value="{{$practica->orden}}">
                            <input type="hidden" name="practica_id" value="{{$practica->id}}">
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 7px">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
