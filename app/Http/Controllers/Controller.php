<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function muro(){
        return view('muro');
    }
    public function inscripcion(){
        return view('inscripcion');
    }
    public function practica(){
        return view('practica');
    }
}
