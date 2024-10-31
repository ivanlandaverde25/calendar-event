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

// Ruta para ver el calendario
Route::get('/prueba', [EventController::class, 'prueba']);

// Ruta para mostrar los eventos registrados en el calendario
Route::get('/mostrar-eventos', [EventController::class, 'mostrarEventos']);

// Ruta para crear un nuevo evento en el calendario
Route::post('/registrar-evento', [EventController::class, 'registrarEvento']);

// Ruta para actualizar la fecha de un evento
Route::put('/actualizar-evento/{id}', [EventController::class, 'actualizarEvento']);

// Ruta temporal para hacer pruebas
// Route::post('/actualizar-evento{id}', [EventController::class, 'actualizarEvento']);

Route::resource('/empleados', EventController::class)
    ->parameters(['empleados' => 'empleado'])
    ->names('empleados');