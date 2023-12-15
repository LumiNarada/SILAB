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
            return view('auth.signup', compact('administrador'));
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
            'titulo'=>'required',
            'nombre'=>'required',
            'apellidos'=>'required',
            'contrasena'=>'required|min:6|max:20|confirmed',
            'contrasena_confirmation'=>'required',
        ]);
        $administrador = new Administrador();
        $administrador->usuario = Str::lower($request->usuario);
        $administrador->titulo = $request->titulo;
        $administrador->nombre = $request->nombre;
        $administrador->apellidos = $request->apellidos;
        $administrador->contrasena = Hash::make($request->contrasena);
        $res = $administrador->save();
        if($res){
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
}
