<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EventController::class)->group(function(){
    Route::get('full-calender', 'index');
    Route::post('full-calender-ajax', 'ajax');
});

Route::get('/prueba', [EventController::class, 'prueba']);
Route::get('/mostrar-eventos', [EventController::class, 'mostrarEventos']);
Route::post('/registrar-evento', [EventController::class, 'registrarEvento']);
