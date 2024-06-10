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
        $practicas = Practica::all()->sortBy('orden');
        if($res){
            return view('muro')->with('success', 'Asignatura agregada correctamente')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        } else {
            return view('muro')->with('fail', 'Error al agregar asignatura. Inténtalo más tarde.')-with($administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        }
    }
    public function modifySubject(Request $request){
        $request->validate([
            'id' => 'required',
            'clave' => 'required',
            'nombre' => 'required',
        ]);
        $asignatura = Asignatura::find($request->id);
        $asignatura->clave = $request->clave;
        $asignatura->nombre = $request->nombre;
        $res = $asignatura->save();


        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        if($res){
            return view('muro')->with('success', 'Asignatura modificada correctamente')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        } else {
            return back()->with('fail', 'Error al modificar asignatura.')-with($administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        }
    }
    public function addPractice(Request $request){
        $request->validate([
            'asignatura' => 'required',
            'orden' => 'required',
            'nombre' => 'required',
            'indicaciones' => 'required',
            'manual' => 'required',
            'previo' => 'required',
        ]);
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();

        $practica = new practica();
        $practica->asignatura_id = $request->asignatura;
        $practica->orden = $request->orden;
        $practica->nombre = $request->nombre;
        $practica->indicaciones = $request->indicaciones;
        $practica->manual = $request->file('manual')->store('');
        $practica->previo = $request->file('previo')->store('');
        $res = $practica->save();
        if($res){
            return redirect()->route('login')->with('success', 'Practica agregada correctamente.');
        } else {
            return redirect()->route('createPractice')->with('fail', 'Error al agregar práctica.')->with('asignaturas',$asignaturas)->with('administrador', $administrador);
        }
    }
    public function createPractice(Request $request){
        $asignaturas = Asignatura::all();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        return view('practice')->with('administrador', $administrador)->with('asignaturas',$asignaturas);
    }

    public function modifyPractice(Request $request)
    {
        $request->validate([
            'asignatura' => 'required',
            'orden' => 'required',
            'nombre' => 'required',
            'indicaciones' => 'required',
        ]);
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();

        $practica = Practica::find($request->id);
        $practica->asignatura_id = $request->asignatura;
        $practica->orden = $request->orden;
        $practica->nombre = $request->nombre;
        $practica->indicaciones = $request->indicaciones;
        if (!empty($request->manual)){
            $practica->manual = $request->file('manual')->store('');
        }
        if (!empty($request->previo)){
            $practica->previo = $request->file('previo')->store('');
        }
        $res = $practica->save();
        if($res){
            return redirect()->back()->with('success', 'Practica modificada correctamente.');
        } else {
            return redirect()->route('createPractice')->with('fail', 'Error al modificar práctica.')->with('asignaturas',$asignaturas)->with('administrador', $administrador);
        }
    }
    public function deleteSubject(Request $request, $id_asignatura)
    {
        return view('deleteSubject')->with('asignatura_id', $id_asignatura);
    }
    public function deletePractice(Request $request, $id_practica)
    {
        return view('deletePractice')->with('practica_id', $id_practica);
    }
    public function destructionSubject(Request $request, $id_asignatura)
    {
        $asignatura = Asignatura::find($id_asignatura)->delete();
        return redirect()->route('muro');
    }
    public function destructionPractice(Request $request, $id_practica)
    {
        $practica = Practica::find($id_practica)->delete();
        return redirect()->route('muro');
    }
}
