<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\controllers\EventController;

Route::get('/', [EventController::class, 'index']); // para mostrar todod os registros
Route::get('/events/create', [EventController::class, 'create'])-> middleware('auth'); //para criar um registro no banco
Route::get('/events/{id}', [EventController::class, 'show']); // para mostrar um dado especifico que esta no banco
Route::post('/events', [EventController::class, 'store']); // para enviar os dados para o banco
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

Route::get('/contact', function() {

    return view('contact');
});

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

Route::get('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
