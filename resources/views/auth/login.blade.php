@extends('layout.app')
@section('content')
<div class="container" id="formulario">
    <div class="container" id="forms">
        <br></br>
        <div class="container" id="inicio"><h3>Iniciar sesión</h3></div>
        <br></br>
        <form action="" method="post">
            <input id="POST-name" type="text" name="name" placeholder="Nombre de usuario"></input>
            <br></br>
            <input id="POST-name" type="text" name="name" placeholder="*********"></input>
            <br></br>
            <div class="boton container"><a href="./muro.html" class="nav-link">Iniciar Sesion</a></div>
            <br>
            <div class="boton container"><a href="#" class="nav-link">Crear Cuenta</a></div>
        </form>
    </div>

</div>
@endsection
