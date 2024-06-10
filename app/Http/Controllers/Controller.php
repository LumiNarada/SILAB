<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Storage;
use App\Models\Administrador;
use App\Models\Asignatura;
use App\Models\Alumno;
use App\Models\Practica;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use function Illuminate\Events\queueable;

class Controller extends BaseController
{
    public function muro(){
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
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
        $asignaturas = Asignatura::all();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $practica=Practica::where('id', '=', $id_practica)->first();
        $asignatura=Asignatura::where('id', '=', $practica->asignatura_id)->first();
        $alumnos = Alumno::all();
        $sesiones=Sesion::where('practica_id', '=', $id_practica)->get();
        foreach ($sesiones as $sesion){
            $sesion->fecha= explode(' ' ,$sesion->fecha);
            $sesion->fechaDia = explode('-' ,$sesion->fecha[0]);
            $sesion->fechaHora = explode(':' ,$sesion->fecha[1]);
        }
        $num=0;
        return view('inscripcion')->with('practica',$practica)->with('administrador', $administrador)->with('alumnos', $alumnos)->with('num', $num)->with('asignatura', $asignatura)->with('asignaturas', $asignaturas)->with('sesiones', $sesiones);
    }

    public function storageAlumno(Request $request){
        $request->validate([
            'practica_id' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'cuenta' => 'required',
            'sesion' => 'required',
            'grupo' => 'required',
        ]);
        $alumno = new Alumno();
        $alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->grupo = $request->grupo;
        $alumno->sesion_id = $request->sesion;
        $alumno->numeroCuenta = $request->cuenta;

        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $inscritos = Alumno::where('sesion_id', '=', $alumno->sesion_id)->get();

        foreach ($inscritos as $inscrito){
            if($inscrito->numeroCuenta == $alumno->numeroCuenta){
                return back()->with('fail', 'El alumno asociado a ese número de cuenta ya se ha inscrito a esta práctica.');
            }
        }
        $res = $alumno->save();

        if($res){
            return view('muro')->with('success', 'Inscripción realizada correctamente')->with('asignaturas',$asignaturas)->with('practicas', $practicas);;
        } else {
            return back()->with('fail', 'Error en proceso de inscripción. Inténtalo más tarde.');
        }
    }
    public function changeScore(Request $request){
        foreach ($request->except('_token') as $id_alumno => $calificacion){
            if ($calificacion != NULL){
                $alumno = Alumno::find($id_alumno);
                $alumno->calificacion = $calificacion;
                $alumno->save();
            }
        }
        return back();
    }

    public function calificaciones(Request $request, $id_calificaciones){
        $practica=Practica::where('id', '=', $id_calificaciones)->first();
        $sesiones=Sesion::all();
        $alumnos = Alumno::orderBy('grupo')->get();
        $asignatura=Asignatura::where('id', '=', $practica->asignatura_id)->first();
        $date = date('Y-m-d');
        $pdf = Pdf::loadView('calificaciones', compact('alumnos', 'practica', 'asignatura', 'date', 'sesiones'))->setPaper('A4');

        return $pdf->stream();
    }

    public function descargar(Request $request, $id_pdf){
        $path = Storage::path("".$id_pdf);
        return response()->download($path);
    }

    public function addSession(Request $request){
        $request->validate([
            'datetime' => 'required'
        ]);
        $sesion = new Sesion();
        $sesion->practica_id = $request->practica_id;
        $sesion->aula=" ";
        $sesion->fecha = $request->datetime;

        $res = $sesion->save();

        if($res){
            return redirect()->back()->with('success', 'Sesión añadida correctamente.');
        } else {
            return redirect()->back()->with('fail', 'Sesión no se pudo añadir.');
        }
    }
}
