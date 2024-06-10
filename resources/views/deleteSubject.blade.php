@extends('layout.app')
@section('content')
    <div class="alert alert-danger" role="alert" style="width: 60%; margin: auto; text-align: center">Acción Destructiva, ¿Desea continuar?</div>
    <div style="text-align: center; display:flex; justify-content: center !important; ">
        <div class="row">
            <div class="col-6" style="margin: auto">
            <form action="{{route('muro')}}" method="get" style="display:flex; flex-direction: row">
                @csrf

                    <button type="submit" class="btn btn-primary">Regresar</button>

            </form>
            </div>
            <div class=" col-6" style="margin: auto">
            <form action="{{ route('destructionSubject', ['id_asignatura' => $asignatura_id]) }}" method="post" style="display:flex; flex-direction: row">
                @csrf

                    <button type="submit" class="btn btn-primary">Eliminar</button>

            </form>
            </div>
        </div>
    </div>
@endsection
