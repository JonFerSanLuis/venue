<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Ruta de la Portada (Bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// Ruta pública para ver el catálogo de festivales
Route::get('/festivales', [FestivalController::class, 'index'])->name('festivals.index');

// Busca tu ruta del dashboard y cámbiala por esta:
Route::get('/dashboard', function () {
    // Buscamos los festivales en la base de datos
    $festivals = \App\Models\Festival::latest()->get();

    // Se los pasamos a la vista
    return view('dashboard', compact('festivals'));
})->middleware(['auth'])->name('dashboard');

// DE PASO, AÑADE ESTA LÍNEA JUSTO DEBAJO PARA EL BOTÓN DE ELIMINAR:
Route::delete('/festivales/{id}', [App\Http\Controllers\FestivalController::class, 'destroy'])->middleware(['auth'])->name('festivals.destroy');

// 4. Ruta para Crear Festivales (Protegida)
Route::get('/festivales/crear', function () {
    return view('festivals.create');
})->middleware(['auth'])->name('festivals.create');

// 5. Rutas de Login y Registro de Laravel Breeze
require __DIR__.'/auth.php';

// Ruta para recibir los datos del formulario y guardarlos (POST)
Route::post('/festivales', [FestivalController::class, 'store'])->middleware(['auth'])->name('festivals.store');