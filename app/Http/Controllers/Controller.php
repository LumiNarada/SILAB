<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Asignatura;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    public function muro(){
        $asignaturas = Asignatura::all();
        $practicas = Practica::all();
        if(Session::has('loginId')){
            $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
            return view('muro')->with('asignaturas',$asignaturas)->with('administrador', $administrador)->with('practicas', $practicas);
        }
        return view('muro')->with('asignaturas',$asignaturas)->with('practicas', $practicas);
    }

    public function inscripcion(Request $request){
        $user = $request->session()->get('loginId');
        return view('inscripcion', compact('user'));
    }
    public function practica(Request $request, $id_practica){
        $practica=Practica::where('id', '=', $id_practica)->first();
        return view('inscripcion')->with('practica',$practica);
    }
}
