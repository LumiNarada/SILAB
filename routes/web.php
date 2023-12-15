<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdministradorController;

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
    Route::get('/login', 'login')->name('login')->middleware('LoggedIn');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/registration', 'registration')->name('registration');
    Route::post('/checkLogIn', 'checkLogIn')->name('checkLogIn');
    Route::get('/logout', 'logout')->name('logout');
});
Route::controller(AdministradorController::class)->group(function(){
    Route::post('/addSubject', 'addSubject')->name('addSubject');
    Route::get('/createPractice', 'createPractice')->name('createPractice')->middleware('AuthCheck');
    Route::post('/addPractice', 'addPractice')->name('addPractice');
});
Route::controller(Controller::class)->group(function(){
    Route::get('/', 'muro')->name('muro');
    Route::get('/muro', 'muro')->name('muro');
    Route::get('/practica/{id_practica}', 'practica')->name('practica');
    Route::get('/inscripcion', 'inscripcion')->name('inscripcion');
});
