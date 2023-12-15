<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function signup(){
        return view('auth.signup');
    }
     public function checkLogIn(Request $request){
         $request->validate([
             'usuario' => 'required',
             'contrasena'=>'required',
         ]);
         $res = Administrador::where('usuario', '=', Str::upper($request->usuario))
             ->count();
         if($res > 0){
             $res = Administrador::where('usuario', '=', Str::upper($request->usuario))
                 ->select('id','contrasena')
                 ->get();
             foreach ($res as $usuario){
                 if($request->contrasena == $usuario->contrasena){
                     $request->session()->put('loginId', $usuario->id);
                     return redirect('muro');
                 }else{
                     return back()->with('fail', 'Contraseña Incorrecta');
                 }
             }
         } else {
             return back()->with('fail', 'Usuario no localizado');
         }
        return view('\muro');
     }
}
