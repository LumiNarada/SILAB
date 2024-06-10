@extends('layout.app')
@section('content')
    <!-- Button trigger modal -->
    <div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left; display: flex; flex-direction: column; justify-content: center">
            <strong style="font-size: 37px; margin: auto" >{{ __('Lista de Asignaturas') }}</strong>
            @if(isset($administrador))
            <button type="button" class="btn btn-info btn-lg btn-block " data-toggle="modal" data-target="#exampleModalCenter" style="width: 100%; margin-bottom: 10px">Agregar Asignatura</button>
            <a href="{{route('createPractice')}}" style="margin: 5px"> <button type="button" class="btn btn-info btn-lg btn-block "  style="width: 100%">Agregar Práctica</button> </a></a>
            @endif
            @error('clave')<div class="subject-section-p"> <div class="alert alert-danger">{{$message}}</div></div>@enderror
            @error('nombre')<div class="subject-section-p"> <div class="alert alert-danger">{{$message}}</div></div>@enderror
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('addSubject')}}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Asignatura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputZip">Clave</label>
                                <input type="number" class="form-control" name="clave">
                            </div>
                            <div class="form-group col-md-10">
                                <label for="inputCity">Nombre</label>
                                <input type="text" class="form-control" name="nombre" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(isset($success))
        <div class="alert alert-success" role="alert" style="width: 60%; margin: auto; text-align: center">{{$success}}</div>
    @endif
    @if(isset($fail))
        <div class="alert alert-danger" role="alert" style="width: 60%; margin: auto; text-align: center">{{$fail}}</div>
    @endif
    @foreach ($asignaturas as $asignatura)
        <div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
            <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
                <div>
                    @if(isset($administrador))
                        <h2 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb;">

                            <div class="row" style="padding: 7px">
                                <form action="{{route('modifySubject')}}" method="post" style="display:flex; flex-direction: row" class="col-10">
                                    @csrf
                                        <div class="form-group col-md-2" style="margin: auto">
                                            <input type="number" class="form-control" name="clave" autocomplete="off" value="{{$asignatura->clave}}">
                                        </div>
                                        <div class="form-group col-md-6" style="margin: auto">
                                            <input type="text" class="form-control" name="nombre" autocomplete="off" value="{{$asignatura->nombre}}">
                                        </div>
                                        <div class="form-group col-md-2" style="margin: auto">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        <input type="hidden" name="id" value="{{$asignatura->id}}">
                                </form>
                                <form action="{{ route('deleteSubject', ['id_asignatura' => $asignatura->id]) }}" method="post" style="display:flex; flex-direction: row" class="col-1">
                                    @csrf
                                    <div class="form-group col-md-2" style="margin: auto">
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </div>
                                </form>
                            </div>

                        </h2>
                    @else
                        <h2 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb; padding: 7px"><strong>{{$asignatura->clave}} {{$asignatura->nombre}}</strong></h2>
                    @endif
                </div>
                @foreach ($practicas as $practica)
                        @if($practica->asignatura_id == $asignatura->id)
                        <div class="subject-section-p">
                            <a href="{{ route('practica', ['id_practica' => $practica->id]) }}" class="link-info" >Práctica {{ $practica->orden}}. {{ $practica->nombre}}</a>
                        </div>
                        @endif
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
