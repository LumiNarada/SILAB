<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SILAB</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
    @foreach ($sesiones as $sesion)
        <h2>{{$asignatura->nombre}}. Práctica {{$practica->orden}}. {{$practica->nombre}}</h2>
        <h3>Sesión {{$num++}}. {{$sesion->fechaDia[2]}} de {{convertMonth($sesion->fechaDia[1])}}, {{$sesion->fechaDia[0]}}. {{$sesion->fechaHora[0]}}:{{$sesion->fechaHora[1]}} - {{$sesion->fechaHora[0]+$sesion->duracionExplode[0]}}:@if($sesion->fechaHora[1]+$sesion->duracionExplode[1]<10)0{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @else{{$sesion->fechaHora[1]+$sesion->duracionExplode[1]}} @endif hrs.</h3>
        <table style="width: 100%; text-align: left">
            <thead>
            <tr>
                <th style="text-align: left">N. Cuenta</th>
                <th style="text-align: left">Grupo</th>
                <th style="text-align: left">Apellidos</th>
                <th style="text-align: left">Nombre</th>
                <th style="text-align: left">C. Previo</th>
                <th style="text-align: left">C. Práctica</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sesion->alumnos as $alumno)
                <tr>
                    <td>{{$alumno->numeroCuenta}}</td>
                    <td>{{$alumno->grupo}}</td>
                    <td>{{$alumno->apellidos}}</td>
                    <td>{{$alumno->nombre}}</td>
                    <td>{{$alumno->calificacionPrevio}}</td>
                    <td>{{$alumno->calificacionPractica}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if ($sesion->id != $ultimaSesion->id)
            <div class="page-break"></div>
        @endif

    @endforeach




        <script src={{asset('assets/bootstrap/js/bootstrap.min.js')}}></script>
    </body>
</html>
