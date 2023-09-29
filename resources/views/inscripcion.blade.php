@extends('layout.app')
@section('content')
<div class="container" id="formulario">
    <div class="container" id="forms">
        <br></br>
        <div class="container" id="inicio"><h3>Insripción</h3></div>
        <br></br>
        <form method="POST" action="{{ route('practica') }}">
            @csrf
            <input id="POST-name" type="text" name="name" placeholder="Numero de cuenta"></input>
            <br></br>
            <input id="POST-name" type="text" name="name" placeholder="Nombre"></input>
            <br></br>
            <input id="POST-name" type="text" name="name" placeholder="Apellido"></input>
            <br></br>
            <input id="POST-name" type="text" name="name" placeholder="Correo@ejemplo.com"></input>
            <br></br>
            <input id="POST-name" type="text" name="name" placeholder="Grupo teoría"></input>
            <br></br>
            <div class="boton container"><a href="{{ route('practica') }}" class="nav-link">Inscribirme</a></div>
        </form>
    </div>
</div>
@endsection
