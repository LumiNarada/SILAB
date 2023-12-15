@extends('layout.app')
@section('content')

    <!-- Button trigger modal -->
    <div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;">
            @if(isset($administrador))
            <button type="button" class="btn btn-info btn-lg btn-block " data-toggle="modal" data-target="#exampleModalCenter" style="width: 100%">Agregar Asignatura</button>
            <a href="{{route('createPractice')}}" style="margin: 5px"> <button type="button" class="btn btn-info btn-lg btn-block "  style="width: 100%">Agregar Práctica</button> </a></a>
            @endif
            @if(Session::has('success'))
                <div class="subject-section-p">
                    <div class="alert alert-succes">{{Session::get('success')}}</div>
                </div>
            @endif
            @if(Session::has('fail'))
                <div class="subject-section-p">
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                </div>
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

    @foreach ($asignaturas as $asignatura)
        <div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
            <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
                <div>
                    <h1 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb;"><strong>{{$asignatura->nombre}}</strong></h1>
                </div>
                @foreach ($practicas as $practica)
                        @if($practica->asignatura_id == $asignatura->id)
                        <div class="subject-section-p">
                            @if(isset($administrador))
                                <p style="color: var(--bs-body-color);">{{ $practica->orden}} {{ $practica->nombre}}<p>
                                <button type="button" class="btn btn-success btn-sm" style="margin: 0px; rigth: auto"> Calificar</button>
                            @else
                                <p style="color: var(--bs-body-color);"> {{ $practica->orden}} {{ $practica->nombre}} </p>
                                <a href="{{ route('practica', ['id_practica' => $practica->id]) }}">       <button type="button" class="btn btn-success btn-sm" style="margin: 0px; rigth: auto"> Inscribirme </button> </a>
                            @endif
                        </div>
                        @endif
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
