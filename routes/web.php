<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Ruta de la Portada (Bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// 2. Ruta Pública del Catálogo de Festivales (La que faltaba)
Route::get('/festivales', function () {
    $festivals = [
        [
            'name' => 'Mad Cool Festival',
            'location' => 'Madrid, España',
            'date' => '10-13 Julio 2026',
            'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=1000',
            'style' => 'Indie / Rock'
        ],
        [
            'name' => 'Primavera Sound',
            'location' => 'Barcelona, España',
            'date' => '28 Mayo - 1 Jun 2026',
            'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80&w=1000',
            'style' => 'Alternativo'
        ],
        [
            'name' => 'Resurrection Fest',
            'location' => 'Viveiro, Galicia',
            'date' => '25-28 Junio 2026',
            'image' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=1000',
            'style' => 'Metal / Punk'
        ],
    ];

    return view('festivals.index', compact('festivals'));
});

// 3. Ruta del Panel de Control (Protegida)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 4. Ruta para Crear Festivales (Protegida)
Route::get('/festivales/crear', function () {
    return view('festivals.create');
})->middleware(['auth'])->name('festivals.create');

// 5. Rutas de Login y Registro de Laravel Breeze
require __DIR__.'/auth.php';