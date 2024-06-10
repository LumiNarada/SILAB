@extends('layout.app')
@section('content')
    <div class="alert alert-danger" role="alert" style="width: 60%; margin: auto; text-align: center">Acción Destructiva, ¿Desea continuar?</div>
    <div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
        <div class="form-row">
            <form action="{{route('muro')}}" method="get" style="display:flex; flex-direction: row">
                @csrf
                <div class="form-group col-md-2" style="margin: auto">
                    <button type="submit" class="btn btn-primary">Regresar</button>
                </div>
            </form>
            <form action="{{ route('destructionPractice', ['id_practica' => $practica_id]) }}" method="post" style="display:flex; flex-direction: row">
                @csrf
                <div class="form-group col-md-2" style="margin: auto">
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
