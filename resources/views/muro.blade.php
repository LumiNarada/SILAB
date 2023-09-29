@extends('layout.app')
@section('content')
<div class="container">
    <div class="titulo container"><h1>Ecuaciones diferenciales</h1></div>
    <div class="formulario container">
        <br>
            <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 1') }}</h3>  </a>
            <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 2') }}</h3>  </a>
            <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 3') }}</h3>  </a>
    </div>
</div>

<br></br>
<div class="container">
    <div class="titulo container"><h1>Algebra Lineal</h1></div>
    <div class="formulario container">
        <br>
        <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 1') }}</h3>  </a>
        <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 2') }}</h3>  </a>
        <a class="nav-link" href="{{ route('practica') }}"> <h3>{{ __('Práctica 3') }}</h3>  </a>
    </div>
</div>
@endsection
