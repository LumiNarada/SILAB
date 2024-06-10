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
    Route::get('/prueba', 'prueba')->name('prueba');
});
Route::controller(AdministradorController::class)->group(function(){
    Route::post('/addSubject', 'addSubject')->name('addSubject');
    Route::post('/modifySubject', 'modifySubject')->name('modifySubject');
    Route::get('/createPractice', 'createPractice')->name('createPractice')->middleware('AuthCheck');
    Route::post('/addPractice', 'addPractice')->name('addPractice');
    Route::post('/modifyPractice', 'modifyPractice')->name('modifyPractice');
    Route::post('/addSession', 'addSession')->name('addSession');
    Route::post('/deletePractice/{id_practica}', 'deletePractice')->name('deletePractice');
    Route::post('/deleteSubject/{id_asignatura}', 'deleteSubject')->name('deleteSubject');
    Route::post('/destructionPractice/{id_practica}', 'destructionPractice')->name('destructionPractice');
    Route::post('/destructionSubject/{id_asignatura}', 'destructionSubject')->name('destructionSubject');
});
Route::controller(Controller::class)->group(function(){
    Route::get('/', 'muro')->name('muro');
    Route::get('/muro', 'muro')->name('muro');
    Route::get('/practica/{id_practica}', 'practica')->name('practica');
    Route::get('/inscripcion', 'inscripcion')->name('inscripcion');
    Route::post('/storageAlumno', 'storageAlumno')->name('storageAlumno');
    Route::post('/changeScore', 'changeScore')->name('changeScore');
    Route::get('/calificaciones/{id_calificaciones}', 'calificaciones')->name('calificaciones');
    Route::get('/pdf/{id_pdf}', 'descargar')->name('descargar');
});
