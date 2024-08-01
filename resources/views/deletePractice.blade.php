@extends('layout.app')
@section('content')
    <div class="alert alert-danger" role="alert" style="width: 60%; margin: auto; text-align: center"> <b> Acción destructiva </b> <br> Eliminará 1 práctica junto con {{ $sesiones }} sesione(s). <br> ¿Desea continuar?</div>
    <div class="d-lg-flex justify-content-lg-center" style="text-align: center; margin: auto">
        <div class="form-row" style="display: flex; flex-direction: row">
            <form action="{{route('practica', $practica_id)}}" method="get" style="display:flex; flex-direction: row; margin-right: 5px">
                @csrf
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Regresar</button>
                </div>
            </form>
            <form action="{{ route('destructionPractice', ['id_practica' => $practica_id]) }}" method="post" style="display:flex; flex-direction: row; margin-left: 5px">
                @csrf
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
