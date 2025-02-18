<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Administrador;
use App\Models\Asignatura;
use App\Models\Alumno;
use App\Models\Carrera;
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
    protected $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = $request->user();
            view()->share('user', $this->user);
            return $next($request);
        });
    }
    public function muro(){
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        if(Session::has('loginId')){
            $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
            return view('muro')->with('asignaturas',$asignaturas)->with('administrador', $administrador)->with('practicas', $practicas);
        }
        return view('muro')->with('asignaturas',$asignaturas)->with('practicas', $practicas);
    }

    public function practica(Request $request, $id_practica){
        $asignaturas = Asignatura::all();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $practica=Practica::where('id', '=', $id_practica)->first();
        if ($practica == NULL) { return redirect('/'); }
        $asignatura=Asignatura::find($practica->asignatura_id);
        $alumnos = Alumno::all();
        $carreras = Carrera::all();
        $sesiones=Sesion::where('practica_id', '=', $id_practica)->orderBy('fecha')->get();
        foreach ($sesiones as $sesion){
            $sesion->fechaExplode= explode(' ' ,$sesion->fecha);
            $sesion->fechaDia = explode('-' ,$sesion->fechaExplode[0]);
            $sesion->fechaHora = explode(':' ,$sesion->fechaExplode[1]);
            $sesion->duracionExplode = explode(':' ,$sesion->duracion);
        }
        $num=1;
        $otroNum=1;
        $myTime = date('Y-m-d').'T12:00';
        return view('inscripcion')->with('practica',$practica)->with('administrador', $administrador)->with('alumnos', $alumnos)->with('otroNum', $otroNum)->with('num', $otroNum)->with('asignatura', $asignatura)->with('asignaturas', $asignaturas)->with('sesiones', $sesiones)->with('carreras',$carreras)->with('myTime',$myTime);
    }

    public function storageAlumno(Request $request){
        $request->validate([
            'practica_id' => 'required',
            'nombre' => 'required|string|min:2|max:100',
            'apellidos' => 'required|string|min:2|max:100',
            'cuenta' => 'required|regex:/^\d{9}$/',
            'sesion' => 'required',
            'carrera' => 'required',
            'grupo' => 'required|integer|min:0|max:255',
            'aviso' => 'required|in:1',
        ],[
            'nombre.required' => 'El campo \'Nombre\' es requerido',
            'apellidos.required' => 'El campo \'Apellidos\' es requerido',
            'cuenta.required' => 'El campo \'Número de Cuenta\' es requerido',
            'cuenta.regex' => 'El número de cuenta debe ser exactamente 9 dígitos numéricos, sin caracteres adicionales.',
            'sesion.required' => 'El campo \'Sesion\' es requerido',
            'carrera.required' => 'El campo \'Carrera\' es requerido',
            'grupo.required' => 'El campo \'Grupo\' es requerido',
            'grupo.integer' => 'El grupo no existe',
            'grupo.min' => 'El grupo no existe',
            'grupo.max' => 'El grupo no existe',
            'aviso.required' => 'Debe aceptar el aviso de privacidad',
        ]);
        $alumno = new Alumno();
        $alumno->nombre = $request->nombre;
        $alumno->apellidos = $request->apellidos;
        $alumno->grupo = $request->grupo;
        $alumno->sesion_id = $request->sesion;
        $alumno->numeroCuenta = $request->cuenta;
        $alumno->carrera_id = $request->carrera;

        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $sesion = Sesion::find($alumno->sesion_id);
        $practica = Practica::find($sesion->practica_id);
        $inscritos = DB::table('alumno')->join('sesion', 'sesion.id', '=', 'alumno.sesion_id')->join('practica', 'practica.id', '=', 'sesion.practica_id')->where('practica_id', '=', $practica->id)->get();
        foreach ($inscritos as $inscrito){
            if($inscrito->numeroCuenta == $alumno->numeroCuenta ){
                return back()->with('fail', 'El alumno asociado a ese número de cuenta ya se ha inscrito a esta práctica.');
            }
        }
        $res = $alumno->save();
        if($res){
            $sesion->vacantes += 1;
            $sesion->save();
            return back()->with('success', 'Inscripción realizada correctamente. Sigue las indicaciones y preséntate el día de la sesión de la práctica.');
        } else {
            return back()->with('fail', 'Error en proceso de inscripción. Inténtalo más tarde.');
        }
    }
    public function changeScore(Request $request){

        foreach ($request->except('_token') as $id_alumno => $calificacion){
            $id_alumno = explode('_', $id_alumno);
            if ($id_alumno[0] == 'previo' && $calificacion != NULL){
                $alumno = Alumno::find($id_alumno[1]);
                $alumno->calificacionPrevio = $calificacion;
                $alumno->save();
            }
            elseif ($id_alumno[0] == 'practica' && $calificacion != NULL){
                $alumno = Alumno::find($id_alumno[1]);
                $alumno->calificacionPractica = $calificacion;
                $alumno->save();
            }

        }
        return back();
    }

    public function calificaciones(Request $request, $id_calificaciones){
        $practica=Practica::where('id', '=', $id_calificaciones)->first();
        $sesiones= Sesion::where('practica_id', '=', $id_calificaciones)
            ->with('alumnos') // Carga los alumnos relacionados con cada sesión
            ->orderby('fecha')
            ->get();
        $ultimaSesion = $sesiones->last();
        foreach ($sesiones as $sesion){
            $sesion->fechaExplode= explode(' ' ,$sesion->fecha);
            $sesion->fechaDia = explode('-' ,$sesion->fechaExplode[0]);
            $sesion->fechaHora = explode(':' ,$sesion->fechaExplode[1]);
            $sesion->duracionExplode = explode(':' ,$sesion->duracion);
        }
        $alumnos = Alumno::orderBy('grupo')->get();
        $asignatura=Asignatura::where('id', '=', $practica->asignatura_id)->first();
        $date = date('Y-m-d');
        $num=1;
        $pdf = Pdf::loadView('calificaciones', compact('alumnos', 'practica', 'asignatura', 'date', 'sesiones','ultimaSesion','num'))->setPaper('A4');
        return $pdf->stream();
    }

    public function descargar(Request $request, $id_asignatura, $id_pdf){
        $path = Storage::path('pdf/'.$id_asignatura.'/'.$id_pdf);
        return response()->download($path);
    }


}
