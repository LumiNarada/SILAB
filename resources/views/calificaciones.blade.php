<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SILAB</title>
</head>
    <h5 style="margin-left:auto " >{{$date}}</h5>
    <h1>{{$asignatura->nombre}}</h1>
    <h2>Práctica {{$practica->orden}}. {{$practica->nombre}}</h2>
    <table style="width: 100%; text-align: left">
        <thead>
        <tr>
            <th style="text-align: left">Grupo</th>
            <th style="text-align: left">Número de Cuenta</th>
            <th style="text-align: left">Apellidos</th>
            <th style="text-align: left">Nombre</th>
            <th style="text-align: left">Calificación</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sesiones as $sesion)
            @if($sesion->practica_id == $practica->id)
                @foreach ($alumnos as $alumno)
                    @if($alumno->sesion_id == $sesion->id)
                    <tr>
                        <td>{{$alumno->grupo}}</td>
                        <td>{{$alumno->numeroCuenta}}</td>
                        <td>{{$alumno->apellidos}}</td>
                        <td>{{$alumno->nombre}}</td>
                        <td>{{$alumno->calificacion}}</td>
                    </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
        <script src={{asset('assets/bootstrap/js/bootstrap.min.js')}}></script>
    </body>
</html>
