<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

 Route::get('/', function () {
    return view('auth.login');
})->name('login'); 

Route::get('/Areas', function () {
    return view('vistas.areas');
})->/* middleware(['auth', 'verified'])-> */name('areas');

Route::get('/Personas', function () {
    return view('vistas.personas');
})->middleware(['auth', 'verified'])->name('personas');

Route::get('/Ingresos', function () {
    return view('vistas.ingresos');
})->middleware(['auth', 'verified'])->name('ingresos');

Route::get('/Historial', function () {
    return view('vistas.historial');
})->middleware(['auth', 'verified'])->name('historial');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   

});

require __DIR__.'/auth.php';
