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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        if ($practica == NULL) { return redirect('/'); }
        $asignatura=Asignatura::where('id', '=', $practica->asignatura_id)->first();
        $alumnos = Alumno::all();
        $sesiones=Sesion::where('practica_id', '=', $id_practica)->orderBy('fecha')->get();
        foreach ($sesiones as $sesion){
            $sesion->fechaExplode= explode(' ' ,$sesion->fecha);
            $sesion->fechaDia = explode('-' ,$sesion->fechaExplode[0]);
            $sesion->fechaHora = explode(':' ,$sesion->fechaExplode[1]);
            $sesion->duracionExplode = explode(':' ,$sesion->duracion);
        }
        $num=1;
        $otroNum=1;
        return view('inscripcion')->with('practica',$practica)->with('administrador', $administrador)->with('alumnos', $alumnos)->with('otroNum', $otroNum)->with('num', $otroNum)->with('asignatura', $asignatura)->with('asignaturas', $asignaturas)->with('sesiones', $sesiones);
    }

    public function storageAlumno(Request $request){
        $request->validate([
            'practica_id' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'cuenta' => 'required',
            'sesion' => 'required',
            'grupo' => 'required',
            'correo'=>['required','regex:/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/']
        ],[
            'nombre.required' => 'El campo \'Nombre\' es requerido',
            'apellidos.required' => 'El campo \'Apellidos\' es requerido',
            'cuenta.required' => 'El campo \'Número de Cuenta\' es requerido',
            'sesion.required' => 'El campo \'Sesion\' es requerido',
            'grupo.required' => 'El campo \'Grupo\' es requerido',
            'correo.required' => 'El campo \'Correo Electrónico\' es requerido',
            'correo.regex' => "El correo electrónico ingresado no es válido"
        ]);
        $alumno = new Alumno();
        $alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->grupo = $request->grupo;
        $alumno->sesion_id = $request->sesion;
        $alumno->numeroCuenta = $request->cuenta;
        $alumno->correo = $request->correo;

        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $sesion = Sesion::find($alumno->sesion_id);
        $practica = Practica::find($sesion->practica_id);
        $inscritos = DB::table('alumno')->join('sesion', 'sesion_id', '=', 'sesion_id')->join('practica', 'practica_id', '=', 'practica_id')->where('practica_id', '=', $practica->id)->get();
        foreach ($inscritos as $inscrito){
            if($inscrito->numeroCuenta == $alumno->numeroCuenta){
                return back()->with('fail', 'El alumno asociado a ese número de cuenta ya se ha inscrito a esta práctica.');
            }
        }
        $res = $alumno->save();
        if($res){
            $sesion->vacantes += 1;
            $sesion->save();
            return back()->with('success', 'Inscripción realizada correctamente. Sigue las indicaciones y preséntate el día de la sesión de laboratiorio. Enviaremos un correo electórnico para recordarte esta información un día antes de la clase.');
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

    public function descargar(Request $request, $id_asignatura, $id_pdf){
        $path = Storage::path('pdf/'.$id_asignatura.'/'.$id_pdf);
        return response()->download($path);
    }


}
