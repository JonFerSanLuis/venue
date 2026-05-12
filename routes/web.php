<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ArtistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. ZONA PÚBLICA (Acceso para todo el mundo)
// ==========================================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/festivales', [FestivalController::class, 'index'])->name('festivals.index');


// ==========================================
// 2. ZONA DE ADMINISTRACIÓN (Solo Admins)
// ==========================================

// Al envolver todo en este 'group', le ponemos el portero a TODAS estas rutas de golpe
Route::middleware(['auth', 'admin'])->group(function () {

    // --- DASHBOARD ---
    Route::get('/dashboard', function () {
        $festivals = \App\Models\Festival::latest()->get();
        $artists = \App\Models\Artist::latest()->get();

        $promotersCount = \App\Models\User::where('role_id', 1)->count(); // ID 1 suele ser Admin en tu Seeder
        $artistsCount = $artists->count();
        $upcomingCount = \App\Models\Festival::where('date', '>=', now())->count();
        $lastFestival = \App\Models\Festival::latest()->first()?->name ?? 'Ninguno';
        $uniqueLocations = \App\Models\Festival::distinct('location')->count('location');

        return view('dashboard', compact(
            'festivals', 'artists', 'promotersCount',
            'artistsCount', 'upcomingCount', 'lastFestival', 'uniqueLocations'
        ));
    })->name('dashboard');


    // --- FESTIVALES ---
    Route::get('/festivales/crear', function () { return view('festivals.create'); })->name('festivals.create');
    Route::post('/festivales', [FestivalController::class, 'store'])->name('festivals.store');
    Route::get('/festivales/{id}/editar', [FestivalController::class, 'edit'])->name('festivals.edit');
    Route::put('/festivales/{id}', [FestivalController::class, 'update'])->name('festivals.update');
    Route::delete('/festivales/{id}', [FestivalController::class, 'destroy'])->name('festivals.destroy');


    // --- CARTEL (LINEUP) ---
    Route::get('/festivales/{id}/cartel', [FestivalController::class, 'lineup'])->name('festivals.lineup');
    Route::post('/festivales/{id}/cartel', [FestivalController::class, 'storeLineup'])->name('festivals.lineup.store');
    Route::delete('/festivales/{festival_id}/cartel/{artist_id}', [FestivalController::class, 'destroyLineup'])->name('festivals.lineup.destroy');


    // --- ARTISTAS ---
    Route::get('/artistas/crear', [ArtistController::class, 'create'])->name('artists.create');
    Route::post('/artistas', [ArtistController::class, 'store'])->name('artists.store');
    Route::get('/artistas/{id}/editar', [ArtistController::class, 'edit'])->name('artists.edit');
    Route::put('/artistas/{id}', [ArtistController::class, 'update'])->name('artists.update');
    Route::delete('/artistas/{id}', [ArtistController::class, 'destroy'])->name('artists.destroy');

});

// ==========================================
// 3. RUTAS DE AUTENTICACIÓN (Breeze)
// ==========================================
require __DIR__.'/auth.php';