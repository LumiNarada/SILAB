<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Asignatura;
use App\Models\Practica;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Alumno;
use Illuminate\Support\Str;

class AdministradorController extends Controller
{
    public function addSubject(Request $request){
        $request->validate([
            'clave' => 'required|unique:asignatura',
            'nombre' => 'required|unique:asignatura',
        ],[
            'clave.required' => 'El campo \'Clave\' es requerido',
            'nombre.required' => 'El campo \'Nombre\' es requerido',
            'clave.unique' => 'La clave ya está registrada',
            'nombre.unique' => 'El nombre ya está registrado',
        ]);
        $asignatura = new asignatura();
        $asignatura->clave = $request->clave;
        $asignatura->nombre = $request->nombre;
        $res = $asignatura->save();
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        if($res){
            return back()->with('success', 'Asignatura agregada correctamente')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        } else {
            return back()->with('fail', 'Error al agregar asignatura. Inténtalo más tarde.')-with($administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        }
    }
    public function modifySubject(Request $request){
        $asignatura = Asignatura::find($request->id);
        if($asignatura->clave != $request->clave){
            $request->validate([
                'clave' => 'required|unique:asignatura',
            ],[
                'clave.required' => 'El campo \'Clave\' es requerido',
                'clave.unique' => 'La clave ya está registrada',
            ]);
        }

        if($asignatura->nombre != $request->nombre){
            $request->validate([
                'nombre' => 'required|unique:asignatura',
            ],[
                'nombre.required' => 'El campo \'Nombre\' es requerido',
                'nombre.unique' => 'El nombre ya está registrado',
            ]);
        }
        $asignatura->clave = $request->clave;
        $asignatura->nombre = $request->nombre;
        $res = $asignatura->save();


        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        if($res){
            return back()->with('success', 'Asignatura modificada correctamente')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
        } else {
            return back()->with('fail', 'Error al modificar asignatura.')->with('administrador', $administrador)->with('asignaturas',$asignaturas)->with('practicas',$practicas);
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
        ],[
            'orden.required' => 'El campo \'N°\' es requerido',
            'nombre.required' => 'El campo \'Nombre de la práctica\' es requerido',
            'indicaciones.required' => 'El campo \'Indicaciones\' es requerido',
            'manual.required' => 'El archivo \'Manual\' es requerido',
            'previo.required' => 'El archivo \'Cuestionario Previo\' es requerido',
        ]);
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();

        $practica = new practica();
        $practica->asignatura_id = $request->asignatura;
        $practica->orden = $request->orden;
        $practica->nombre = $request->nombre;
        $practica->indicaciones = $request->indicaciones;
        $practica->manual = $request->file('manual')->storeAs('pdf/'.$request->asignatura.'/Manual'.$request->orden.'_'.$request->nombre.'.'.$request->file('manual')->getClientOriginalExtension());
        $practica->previo = $request->file('previo')->storeAs('pdf/'.$request->asignatura.'/Previo'.$request->orden.'_'.$request->nombre.'.'.$request->file('previo')->getClientOriginalExtension());
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
        ],[
            'orden.required' => 'El campo \'N°\' es requerido',
            'nombre.required' => 'El campo \'Nombre de la práctica\' es requerido',
            'indicaciones.required' => 'El campo \'Indicaciones\' es requerido',
        ]);
        $asignaturas = Asignatura::all();
        $practicas = Practica::all()->sortBy('orden');
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        $practica = Practica::find($request->id);
        $practica->asignatura_id = $request->asignatura;
        if ((($practica->nombre != $request->nombre)||($practica->orden != $request->orden)) && empty($request->manual)){
            $explodePrevio=explode('.',$practica->previo);
            $explodeManual=explode('.',$practica->manual);
            Storage::move($practica->manual, 'pdf/'.$request->asignatura.'/Manual'.$request->orden.'.'.$request->nombre.'.'.end($explodeManual));
            Storage::move($practica->previo, 'pdf/'.$request->asignatura.'/Previo'.$request->orden.'.'.$request->nombre.'.'.end($explodePrevio));
            $practica->manual = 'pdf/'.$request->asignatura.'/Manual'.$request->orden.'.'.$request->nombre.'.'.end($explodeManual);
            $practica->previo = 'pdf/'.$request->asignatura.'/Previo'.$request->orden.'.'.$request->nombre.'.'.end($explodePrevio);
        }
        $practica->orden = $request->orden;
        $practica->nombre = $request->nombre;
        $practica->indicaciones = $request->indicaciones;
        if (!empty($request->manual)){
            Storage::delete($practica->manual);
            $practica->manual = $request->file('manual')->storeAs('pdf/'.$request->asignatura.'/Manual'.$request->orden.'_'.$request->nombre.'.'.$request->file('manual')->getClientOriginalExtension());
        }
        if (!empty($request->previo)){
            Storage::delete($practica->previo);
            $practica->previo = $request->file('previo')->storeAs('pdf/'.$request->asignatura.'/Previo'.$request->orden.'_'.$request->nombre.'.'.$request->file('previo')->getClientOriginalExtension());
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
        $asignatura = Asignatura::find($id_asignatura);
        $practicas = Practica::where('asignatura_id',$id_asignatura)->count();
        return view('deleteSubject')->with('asignatura_id', $id_asignatura)->with('asignatura', $asignatura)->with('practicas', $practicas);
    }
    public function deletePractice(Request $request, $id_practica)
    {
        $sesiones = Sesion::where('practica_id', $id_practica)->count();
        return view('deletePractice')->with('practica_id', $id_practica)->with('sesiones', $sesiones);
    }
    public function deleteSession(Request $request, $id_sesion)
    {
        $alumnos = Alumno::where('sesion_id', $id_sesion)->count();
        $practica = Sesion::where('id', $id_sesion)->pluck('practica_id');
        return view('deleteSession')->with('sesion_id', $id_sesion)->with('alumnos', $alumnos)->with('practica',$practica);
    }
    public function deleteAlumn(Request $request, $id_alumno)
    {
        $alumno = Alumno::find($id_alumno);
        $practica = Sesion::where('id', $alumno->sesion_id)->pluck('practica_id');
        $practicaNombre = Practica::where('id', $practica[0])->pluck('nombre');
        return view('deleteAlumn')->with('alumno', $alumno)->with('practica',$practica)->with('practicaNombre',$practicaNombre);
    }
    public function destructionSession(Request $request, $id_sesion)
    {
        Alumno::where('sesion_id', $id_sesion)->delete();
        $sesion=Sesion::where('id',$id_sesion)->pluck('practica_id');
        Sesion::where('id',$id_sesion)->delete();
        return redirect()->route('practica',$sesion[0]);
    }
    public function destructionSubject(Request $request, $id_asignatura)
    {
        $practicas=Practica::where('asignatura_id',$id_asignatura)->get();
        foreach ($practicas as $practica){
            $sesion = Sesion::where('practica_id',$practica->id)->delete();
            Storage::delete($practica->manual);
            Storage::delete($practica->previo);
        }
        $practicas=Practica::where('asignatura_id',$id_asignatura)->delete();
        $asignatura = Asignatura::find($id_asignatura)->delete();
        return redirect()->route('muro');
    }
    public function destructionPractice(Request $request, $id_practica)
    {
        Sesion::where('practica_id',$id_practica)->delete();
        $practica=Practica::find($id_practica);
        Storage::delete($practica->manual);
        Storage::delete($practica->previo);
        Practica::find($id_practica)->delete();
        return redirect()->route('muro')->with('success', 'Práctica Eliminada');
    }
    public function destructionAlumn(Request $request, $id_alumno)
    {
        $alumno = Alumno::find($id_alumno);
        $sesion = Sesion::find($alumno->sesion_id);
        $sesion->vacantes -= 1;
        $sesion->save();
        Alumno::find($id_alumno)->delete();
        return redirect()->route('practica',$sesion->practica_id)->with('success', 'Alumno dado de baja');
    }

    public function addSession(Request $request){
        $request->validate([
            'datetime' => 'required',
            'time' => 'required',
            'aula' => 'required',
            'cupo' => 'required'
        ],[
            'datetime.required' => 'El campo \'Fecha y hora\' es requerido',
            'time.required' => 'El campo \'Duración\' es requerido',
            'aula.required' => 'El campo \'Aula\' es requerido',
            'cupo.required' => 'El campo \'Cupo\' es requerido',
        ]);
        $sesion = new Sesion();
        $sesion->practica_id = $request->practica_id;
        $sesion->aula=$request->aula;
        $sesion->profesor=$request->profesor;
        $sesion->fecha = $request->datetime;
        $sesion->duracion = $request->time;
        $sesion->cupo = $request->cupo;
        $sesion->vacantes = 0;

        $res = $sesion->save();

        if($res){
            return redirect()->back()->with('success', 'Sesión añadida correctamente.');
        } else {
            return redirect()->back()->with('fail', 'Sesión no se pudo añadir.');
        }
    }

    public function modifySession(Request $request)
    {
        $request->validate([
            'datetime' => 'required',
            'time' => 'required',
            'aula' => 'required',
            'cupo' => 'required'
        ],[
            'datetime.required' => 'El campo \'Fecha y hora\' es requerido',
            'time.required' => 'El campo \'Duración\' es requerido',
            'aula.required' => 'El campo \'Aula\' es requerido',
            'cupo.required' => 'El campo \'Cupo\' es requerido',
        ]);

        $sesion = Sesion::find($request->sesion_id);

        if($request->cupo < $sesion->vacantes){
            return redirect()->back()->with('fail', 'Cupo menor a vacantes ocupadas de alumnos inscritos');
        }

        $sesion->aula=$request->aula;
        $sesion->profesor=$request->profesor;
        $sesion->fecha = $request->datetime;
        $sesion->duracion = $request->time;
        $sesion->cupo = $request->cupo;

        $res = $sesion->save();
        if($res){
            return redirect()->back()->with('success', 'Sesión modificada correctamente.');
        } else {
            return redirect()->back()->with('fail', 'Sesión no se pudo modificar.');
        }
    }
    public function modifyAdministrator(Request $request)
    {
        $admin = Administrador::find($request->id);
        $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
        if (!$admin){return back();}
        return view('modifyAdmin')-> with('admin', $admin)-> with('administrador', $administrador);
    }
    public function destructionAdministrator(Request $request)
    {
        $count = Administrador::count();
        if ($count>1){
            Administrador::find($request->id)->delete();
            return back();
        }
        return back();
    }
    public function ChangeAdmin(Request $request)
    {
        $admin = Administrador::find($request->id);
        if ($admin->usuario != $request->usuario){
            $request->validate([
                'usuario'=>'unique:administrador',
            ],[
                'usuario.unique' => 'El nombre de usuario no está disponible',
            ]);
        }
        $admin->usuario = $request->usuario;
        if($request->contrasena != NULL){
            $request->validate([
                'contrasena'=>['required','min:6','max:20','confirmed','regex:/(?=\w*\d)((?=\w*[A-Z])|(?=\w*[a-z]))\S{6,20}/'],
            ],[
                'contrasena.min' => 'El campo \'Contraseña\' debe tener una longitud de 6 caracteres',
                'contrasena.max' => 'El campo \'Contraseña\' debe tener menos de 20 caracteres',
                'contrasena.confirmed' => 'La confimación del campo \'Contraseña\' no coincide',
                'contrasena.regex' => "La contraseña debe tener al menos una letra y un número.",
            ]);
        }
        $admin->contrasena = Hash::make($request->contrasena);
        $request->validate([
            'usuario'=>'required',
            'nombre'=>'required',
            'apellidos'=>'required',
        ],[
            'usuario.required' => 'El campo \'Usuario\' es requerido',
            'nombre.required' => 'El campo \'Nombre\' es requerido',
            'apellidos.required' => 'El campo \'Apellido\' es requerido',
        ]);
        $admin->usuario = Str::lower($request->usuario);
        $admin->nombre = $request->nombre;
        $admin->apellidos = $request->apellidos;
        $admin->save();
        return redirect('signup')->with('success','Información modificada correctamente');
    }
}
