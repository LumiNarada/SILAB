@extends('layout.app')
@section('content')
    <strong style="font-size: 37px; margin: auto" >{{ __('Agregar Práctica') }}</strong>

    <div class="d-lg-flex justify-content-lg-center" style="text-align: center" >
        <div class="container border-3 border-primary focus-ring subject-section" style="margin: 10px;padding: 0px;color: rgb(33, 37, 41);text-align: left;background: var(--bs-secondary-bg);">
            <div>
                <form style="padding: 30px" method="post" action="{{route('addPractice')}}" enctype="multipart/form-data">
                    @if(Session::has('success'))
                        <div class="alert alert-succes" role="alert">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger" role="alert">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div style="display: flex; flex-direction: row; ">
                        <p style="font-size: large; color: #cd171e; margin: 0px;">* &nbsp;</p> <p style="font-size: small; color: #cd171e; margin: 0px"">Campo obligatorio</p>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label for="inputPassword4" style="display:flex; flex-direction: row">Asignatura  &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                                <select name="asignatura" id="asignatura" class="form-control">
                                    @foreach($asignaturas as $asignatura)
                                        <option value="{{$asignatura->id}}">{{$asignatura->nombre}}</option>
                                    @endforeach
                                </select>
                            <span class="text-danger">@error('asignatura'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4" style="display:flex; flex-direction: row">N° de Práctica &nbsp;<p style="font-size: large; color: #cd171e; margin: 0px;">*</p></label>
                            <input type="number" class="form-control" name="orden" placeholder="#">
                            <span class="text-danger">@error('orden'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4" style="display:flex; flex-direction: row">Nombre de la práctica &nbsp; <p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" autocomplete="off">
                            <span class="text-danger">@error('nombre'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4" style="display:flex; flex-direction: row">Indicaciones &nbsp; <p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                            <input type="text" class="form-control" name="indicaciones" placeholder="Indicaciones">
                            <span class="text-danger">@error('indicaciones'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 1px">
                        <div class="form-group col-md-6" style="margin-top: 5px; padding: 0px">
                            <label class="custom-file-label" for="customFile" style="display:flex; flex-direction: row">Cuestionario Previo &nbsp; <p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                            <input type="file" class="custom-file-input" name="previo">
                            <span class="text-danger">@error('previo'){{$message}}@enderror</span>
                        </div>
                        <div class="form-group col-md-6" style="margin-top: 5px; padding: 0px">
                            <label class="custom-file-label" for="customFile" style="display:flex; flex-direction: row">Manual &nbsp; <p style="font-size: large; color: #cd171e; margin: 0px;">*</p> </label>
                            <input type="file" class="custom-file-input" name="manual">
                            <span class="text-danger">@error('manual'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Enviar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
