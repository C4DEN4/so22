<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\HistorialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login'); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/areas', [AreaController::class, 'index'])->name('areas');
    Route::post('/areas', [AreaController::class, 'store'])->name('areas.store');
    Route::patch('/areas/{area}', [AreaController::class, 'update'])->name('areas.update');
    
    Route::get('/personas', [PersonaController::class, 'index'])->name('personas');
    Route::post('/personas', [PersonaController::class, 'store'])->name('personas.store');
    Route::patch('/personas/{persona}', [PersonaController::class, 'update'])->name('personas.update');

    Route::get('/ingresos', [IngresoController::class, 'index'])->name('ingresos');
    Route::post('/ingresos', [IngresoController::class, 'store'])->name('ingresos.store');
    Route::patch('/ingresos/{ingreso}', [IngresoController::class, 'update'])->name('ingresos.update');
    Route::patch('/ingresos/{ingreso}/checkout', [IngresoController::class, 'checkout'])->name('ingresos.checkout');
    
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial');
});

require __DIR__.'/auth.php';
