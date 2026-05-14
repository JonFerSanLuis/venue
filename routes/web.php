<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\OrderController;

// ==========================================
// 1. ZONA PÚBLICA
// ==========================================

Route::get('/', function () {
    return view('welcome');
});

// Cartelera pública
Route::get('/festivales', [FestivalController::class, 'index'])->name('festivals.index');


// ==========================================
// 2. ZONA DE USUARIO AUTENTICADO
// ==========================================

Route::middleware(['auth'])->group(function () {

    // Checkout y compra
    Route::get('/festivales/{festival_id}/comprar/{ticket_type_id}', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/festivales/{festival_id}/comprar/{ticket_type_id}', [OrderController::class, 'store'])->name('orders.store');

    // Confirmación y mis pedidos
    Route::get('/pedidos/{order_id}/confirmacion', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/mis-entradas', [OrderController::class, 'myOrders'])->name('orders.my-orders');

});


// ==========================================
// 3. ZONA DE ADMINISTRACIÓN
// ==========================================

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $festivals      = \App\Models\Festival::latest()->get();
        $artists        = \App\Models\Artist::latest()->get();
        $promotersCount = \App\Models\User::where('role_id', 1)->count();
        $artistsCount   = $artists->count();
        $upcomingCount  = \App\Models\Festival::where('date', '>=', now())->count();
        $lastFestival   = \App\Models\Festival::latest()->first()?->name ?? 'Ninguno';
        $uniqueLocations= \App\Models\Festival::distinct('location')->count('location');
        $recentOrders   = \App\Models\Order::with(['ticketType.festival', 'user'])->latest()->take(10)->get();

        return view('dashboard', compact(
            'festivals', 'artists', 'promotersCount',
            'artistsCount', 'upcomingCount', 'lastFestival',
            'uniqueLocations', 'recentOrders'
        ));
    })->name('dashboard');

    // Festivales — rutas con segmento fijo ANTES que las dinámicas
    Route::get('/festivales/crear', function () { return view('festivals.create'); })->name('festivals.create');
    Route::post('/festivales', [FestivalController::class, 'store'])->name('festivals.store');
    Route::get('/festivales/{id}/editar', [FestivalController::class, 'edit'])->name('festivals.edit');
    Route::put('/festivales/{id}', [FestivalController::class, 'update'])->name('festivals.update');
    Route::delete('/festivales/{id}', [FestivalController::class, 'destroy'])->name('festivals.destroy');

    // Lineup
    Route::get('/festivales/{id}/cartel', [FestivalController::class, 'lineup'])->name('festivals.lineup');
    Route::post('/festivales/{id}/cartel', [FestivalController::class, 'storeLineup'])->name('festivals.lineup.store');
    Route::delete('/festivales/{festival_id}/cartel/{artist_id}', [FestivalController::class, 'destroyLineup'])->name('festivals.lineup.destroy');

    // Artistas
    Route::get('/artistas/crear', [ArtistController::class, 'create'])->name('artists.create');
    Route::post('/artistas', [ArtistController::class, 'store'])->name('artists.store');
    Route::get('/artistas/{id}/editar', [ArtistController::class, 'edit'])->name('artists.edit');
    Route::put('/artistas/{id}', [ArtistController::class, 'update'])->name('artists.update');
    Route::delete('/artistas/{id}', [ArtistController::class, 'destroy'])->name('artists.destroy');

});


// ==========================================
// 4. DETALLE PÚBLICO DE FESTIVAL
// Al final para que no capture /festivales/crear
// ==========================================

Route::get('/festivales/{id}', [FestivalController::class, 'show'])->name('festivals.show');


// ==========================================
// 5. AUTENTICACIÓN
// ==========================================

require __DIR__.'/auth.php';