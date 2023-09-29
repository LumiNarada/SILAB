<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'login')->name('login');
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/registration', 'registration')->name('registration');
    Route::post('/initialization', 'initialization')->name('initialization');
});

Route::controller(Controller::class)->group(function(){
    Route::get('/muro', 'muro')->name('muro');
    Route::get('/practica', 'practica')->name('practica');
    Route::get('/inscripcion', 'inscripcion')->name('inscripcion');
});
