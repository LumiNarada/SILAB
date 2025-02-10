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
    Route::get('/registration', 'muro')->name('registrationGet');
    Route::get('/checkLogIn', 'muro')->name('checkLogInGet');
});
Route::controller(AdministradorController::class)->group(function(){
    Route::get('/createPractice', 'createPractice')->name('createPractice')->middleware('AuthCheck');
    Route::get('/modifyAdministrator/{id_practica}', 'modifyAdministrator')->name('modifyAdministrator')->middleware('AuthCheck');
    Route::get('/deleteSession/{id_sesion}', 'deleteSession')->name('deleteSession')->middleware('AuthCheck');
    Route::get('/deleteAlumn/{id_alumno}', 'deleteAlumn')->name('deleteAlumn')->middleware('AuthCheck');
    Route::post('/addSubject', 'addSubject')->name('addSubject')->middleware('AuthCheck');
    Route::post('/modifySubject', 'modifySubject')->name('modifySubject')->middleware('AuthCheck');
    Route::post('/addPractice', 'addPractice')->name('addPractice')->middleware('AuthCheck');
    Route::post('/modifyPractice', 'modifyPractice')->name('modifyPractice')->middleware('AuthCheck');
    Route::post('/modifySession', 'modifySession')->name('modifySession')->middleware('AuthCheck');
    Route::post('/addSession', 'addSession')->name('addSession')->middleware('AuthCheck');
    Route::post('/deletePractice/{id_practica}', 'deletePractice')->name('deletePractice')->middleware('AuthCheck');
    Route::post('/deleteSubject/{id_asignatura}', 'deleteSubject')->name('deleteSubject')->middleware('AuthCheck');
    Route::post('/destructionSession/{id_sesion}', 'destructionSession')->name('destructionSession')->middleware('AuthCheck');
    Route::post('/destructionPractice/{id_practica}', 'destructionPractice')->name('destructionPractice')->middleware('AuthCheck');
    Route::post('/destructionSubject/{id_asignatura}', 'destructionSubject')->name('destructionSubject')->middleware('AuthCheck');
    Route::post('/destructionAlumn/{id_alumno}', 'destructionAlumn')->name('destructionAlumn')->middleware('AuthCheck');
    Route::post('/destructionAdministrator', 'destructionAdministrator')->name('destructionAdministrator')->middleware('AuthCheck');
    Route::post('/changeAdmin', 'changeAdmin')->name('changeAdmin')->middleware('AuthCheck');
    Route::get('/addSubject', 'muro')->name('addSubjectGet')->middleware('AuthCheck');
    Route::get('/modifySubject', 'muro')->name('modifySubjectGet')->middleware('AuthCheck');
    Route::get('/addPractice', 'muro')->name('addPracticeGet')->middleware('AuthCheck');
    Route::get('/modifyPractice', 'muro')->name('modifyPracticeGet')->middleware('AuthCheck');
    Route::get('/modifySession', 'muro')->name('modifySessionGet')->middleware('AuthCheck');
    Route::get('/addSession', 'muro')->name('addSessionGet')->middleware('AuthCheck');
    Route::get('/deletePractice/{id_practica}', 'muro')->name('deletePracticeGet')->middleware('AuthCheck');
    Route::get('/deleteSubject/{id_asignatura}', 'muro')->name('deleteSubjectGet')->middleware('AuthCheck');
    Route::get('/destructionSession/{id_sesion}', 'muro')->name('destructionSessionGet')->middleware('AuthCheck');
    Route::get('/destructionPractice/{id_practica}', 'muro')->name('destructionPracticeGet')->middleware('AuthCheck');
    Route::get('/destructionSubject/{id_asignatura}', 'muro')->name('destructionSubjectGet')->middleware('AuthCheck');
    Route::get('/destructionAlumn/{id_alumno}', 'muro')->name('destructionAlumnGet')->middleware('AuthCheck');
    Route::get('/destructionAdministrator', 'muro')->name('destructionAdministratorGet')->middleware('AuthCheck');
    Route::get('/changeAdmin', 'muro')->name('changeAdminGet')->middleware('AuthCheck');
});
Route::controller(Controller::class)->group(function(){
    Route::get('/', 'muro')->name('muro');
    Route::get('/muro', 'muro')->name('muro');
    Route::get('/practica/{id_practica}', 'practica')->name('practica');
    Route::get('/inscripcion', 'inscripcion')->name('inscripcion');
    Route::post('/storageAlumno', 'storageAlumno')->name('storageAlumno');
    Route::post('/changeScore', 'changeScore')->name('changeScore');
    Route::get('/calificaciones/{id_calificaciones}', 'calificaciones')->name('calificaciones');
    Route::get('/pdf/{id_asignatura}/{id_pdf}', 'descargar')->name('descargar');
    Route::get('/storageAlumno', 'muro')->name('storageAlumnoGet');
    Route::get('/changeScore', 'muro')->name('changeScoreGet');
});
