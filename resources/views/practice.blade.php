@extends('layout.app')
@section('content')

    <div class="d-lg-flex justify-content-lg-center" style="text-align: center" >
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
            <div>
                <form style="padding: 30px" method="post" action="{{route('addPractice')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputPassword4">Asignatura</label>
                            @foreach($asignaturas as $asignatura)
                                <select name="asignatura" id="asignatura" class="form-control">
                                    <option value="{{$asignatura->id}}">{{$asignatura->nombre}}</option>
                                </select>
                            @endforeach
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">N° de Práctica</label>
                            <input type="number" class="form-control" name="orden" placeholder="#">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Indicaciones</label>
                            <input type="text" class="form-control" name="indicaciones" placeholder="Indicaciones">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="file" class="custom-file-input" name="previo">
                            <label class="custom-file-label" for="customFile">Escoger archivo de Cuestionario Previo</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="file" class="custom-file-input" name="manual">
                            <label class="custom-file-label" for="customFile">Escoger archivo de manual</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
