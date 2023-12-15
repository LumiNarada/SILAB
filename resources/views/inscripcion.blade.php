@extends('layout.app')
@section('content')

    <div class="d-lg-flex justify-content-lg-center" style="text-align: center" >
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
            <div>
                <form style="padding: 30px" method="get" action="{{route('muro')}}" >
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputPassword4">Practica</label>
                            <input class="form-control" type="text" placeholder="{{$practica->nombre}}" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">N° de Práctica</label>
                            <input type="number" class="form-control" name="orden" placeholder="{{$practica->orden}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Número de cuenta</label>
                            <input type="number" class="form-control" name="cuenta" placeholder="#########">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Grupo Terórico</label>
                            <input type="number" class="form-control" name="grupo" placeholder="#">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <button type="button" class="btn btn-primary btn-sm">Descargar manual</button>
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" class="btn btn-primary btn-sm">Descargar cuestionario previo</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
