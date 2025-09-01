<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){
            return view('auth.login');
    }
    public function signup(){
        if(Session::has('loginId')){
            $administrador = Administrador::where('id', '=', Session::get('loginId'))->first();
            $administradores = Administrador::get();
            $count = Administrador::count();
            return view('auth.signup', compact('administrador'))->with('administradores',$administradores)->with('count',$count);
        }
        else{
            $administrador = Administrador::find(1);
            if ($administrador){
                return redirect()->route('muro');
            }
        }
        return view('auth.signup');
    }
     public function checkLogIn(Request $request){
         $request->validate([
             'usuario' => 'required',
             'contrasena'=>'required',
         ]);
         $administrador = Administrador::where('usuario', '=', Str::lower($request->usuario))->first();
         if($administrador){
             if(Hash::check($request->contrasena, $administrador->contrasena)){
                 $request->session()->put('loginId', $administrador->id);
                 return redirect('muro');
             }else{
                 return back()->with('fail', 'Contraseña Incorrecta');
             }
         } else {
             return back()->with('fail', 'Usuario no localizado');
         }
        return view('\muro');
     }
    public function registration(Request $request){
        $request->validate([
            'usuario'=>'required|unique:administrador',
            'nombre'=>'required',
            'apellidos'=>'required',
            'contrasena'=>['required','min:6','max:20','confirmed','regex:/(?=\w*\d)((?=\w*[A-Z])|(?=\w*[a-z]))\S{6,20}/'],
            'contrasena_confirmation'=>'required',
        ],[
            'usuario.required' => 'El campo \'Usuario\' es requerido',
            'usuario.unique' => 'El nombre de usuario no está disponible',
            'nombre.required' => 'El campo \'Nombre\' es requerido',
            'apellidos.required' => 'El campo \'Apellido\' es requerido',
            'contrasena.required' => 'El campo \'Contraseña\' es requerido',
            'contrasena.min' => 'El campo \'Contraseña\' debe tener una longitud de 6 caracteres',
            'contrasena.max' => 'El campo \'Contraseña\' debe tener menos de 20 caracteres',
            'contrasena.confirmed' => 'La confimación del campo \'Contraseña\' no coincide',
            'contrasena_confirmation.required' => 'El campo \'Confirmar Contraseña\' es requerido',
            'contrasena.regex' => "La contraseña debe tener al menos una letra y un número."
        ]);
        $administrador = new Administrador();
        $administrador->usuario = Str::lower($request->usuario);
        $administrador->nombre = $request->nombre;
        $administrador->apellidos = $request->apellidos;
        $administrador->contrasena = Hash::make($request->contrasena);
        $res = $administrador->save();
        if($res){
            $count = Administrador::count();
            if ($count>1){
                return back();
            }
            return view('auth.login')->with('success', 'Usuario administrador registrado correctamente');
        } else {
            return back()->with('fail', 'Error al registrar usuario. Inténtalo más tarde.');
        }
    }
    public function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('/');
        }
    }

    public function prueba(){
        return view('prueba');
    }
}
