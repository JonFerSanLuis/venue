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

// Ruta 1: La Landing Page (Bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// Ruta 2: El catálogo de festivales que hicimos antes
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
            'image' => 'https://images.unsplash.com/photo-1540039155732-d688d01d4a3b?auto=format&fit=crop&q=80&w=1000',
            'style' => 'Metal / Punk'
        ],
    ];

    return view('festivals.index', compact('festivals'));
});