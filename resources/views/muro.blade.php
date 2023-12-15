@extends('layout.app')
@section('content')
<div class="d-lg-flex justify-content-lg-center" style="text-align: center;">
    <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
        <div>
            <h1 class=".subject-section-heading" style="text-align: center;background: #cd171e;color: #faf8fb;"><strong>Ecuaciones Diferenciales</strong></h1>
        </div>
        <div class="subject-section-p"><a href="{{ route('practica') }}" style="color: var(--bs-body-color);">{{ __('Práctica 1. Análisis de ecuaciones de primer grado') }} </a></div>
    </div>
</div>
@endsection
