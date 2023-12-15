<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    public function muro(Request $request){
        $user = $request->session()->get('loginId');
        return view('muro', compact('user'));
    }
    public function inscripcion(Request $request){
        $user = $request->session()->get('loginId');
        return view('inscripcion', compact('user'));
    }
    public function practica(Request $request){
        $user = $request->session()->get('loginId');
        return view('practica', compact('user'));
    }
    public function logout(){
        if (Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
