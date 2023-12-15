<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Asignatura;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdministradorController extends Controller
{
    public function addSubject(Request $request){
        $request->validate([
            'clave' => 'required|unique:asignatura',
            'nombre' => 'required|unique:asignatura',
        ]);
        $asignatura = new asignatura();
        $asignatura->clave = $request->clave;
        $asignatura->nombre = $request->nombre;
        $res = $asignatura->save();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $asignaturas = Asignatura::all();
        $practicas = Practica::all();
        if($res){
            return view('muro')->with('success', 'Asignatura agregada correctamente')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        } else {
            return view('muro')->with('fail', 'Error al agregar asignatura. Inténtalo más tarde.')-with($administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        }
    }
    public function addPractice(Request $request){
        $request->validate([
            'asignatura' => 'required',
            'orden' => 'required',
            'nombre' => 'required',
            'indicaciones' => 'required'
        ]);
        //$request->file('manual')->store('public');
        $practica = new practica();
        $practica->asignatura_id = $request->asignatura;
        $practica->orden = $request->orden;
        $practica->nombre = $request->nombre;
        $practica->indicaciones = $request->indicaciones;
        $practica->manual = "1.pdf";
        $practica->previo = "2.pdf";
        $res = $practica->save();
        $asignaturas = Asignatura::all();
        $practicas = Practica::all();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        if($res){
            return view('muro')->with('success', 'Practica agregada correctamente')->with('asignaturas',$asignaturas)->with('administrador', $administrador)->with('practicas', $practicas);;
        } else {
            return view('createPractie')->with('fail', 'Error al agregar asignatura. Inténtalo más tarde.')->with('asignaturas',$asignaturas)->with('administrador', $administrador);
        }
    }
    public function createPractice(Request $request){
        $asignaturas = Asignatura::all();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        return view('practice')->with('administrador', $administrador)->with('asignaturas',$asignaturas);;

    }
}
