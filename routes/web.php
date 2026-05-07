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

// AQUI VA TODA LA LOGICA DEL DASHBOARD
Route::get('/dashboard', function () {
    // Traemos los festivales y los artistas
    $festivals = \App\Models\Festival::latest()->get();
    $artists = \App\Models\Artist::latest()->get(); // <--- Nueva línea

    // Estadísticas
    $promotersCount = \App\Models\User::count();
    $artistsCount = $artists->count();
    $upcomingCount = \App\Models\Festival::where('date', '>=', now())->count();
    $lastFestival = \App\Models\Festival::latest()->first()?->name ?? 'Ninguno';
    $uniqueLocations = \App\Models\Festival::distinct('location')->count('location');

    return view('dashboard', compact(
        'festivals',
        'artists', // <--- Lo pasamos a la vista
        'promotersCount',
        'artistsCount',
        'upcomingCount',
        'lastFestival',
        'uniqueLocations'
    ));
})->middleware(['auth'])->name('dashboard');

// DE PASO, AÑADE ESTA LÍNEA JUSTO DEBAJO PARA EL BOTÓN DE ELIMINAR:
Route::delete('/festivales/{id}', [App\Http\Controllers\FestivalController::class, 'destroy'])->middleware(['auth'])->name('festivals.destroy');

// Rutas para EDITAR un festival
Route::get('/festivales/{id}/editar', [App\Http\Controllers\FestivalController::class, 'edit'])->middleware(['auth'])->name('festivals.edit');
Route::put('/festivales/{id}', [App\Http\Controllers\FestivalController::class, 'update'])->middleware(['auth'])->name('festivals.update');

// 4. Ruta para Crear Festivales (Protegida)
Route::get('/festivales/crear', function () {
    return view('festivals.create');
})->middleware(['auth'])->name('festivals.create');

// 5. Rutas de Login y Registro de Laravel Breeze
require __DIR__.'/auth.php';

// Ruta para recibir los datos del formulario y guardarlos (POST)
Route::post('/festivales', [FestivalController::class, 'store'])->middleware(['auth'])->name('festivals.store');

// Artistas
// Rutas para Artistas
Route::get('/artistas/crear', [App\Http\Controllers\ArtistController::class, 'create'])->middleware(['auth'])->name('artists.create');
Route::post('/artistas', [App\Http\Controllers\ArtistController::class, 'store'])->middleware(['auth'])->name('artists.store');
Route::delete('/artistas/{id}', [App\Http\Controllers\ArtistController::class, 'destroy'])->middleware(['auth'])->name('artists.destroy');