<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncuestaController;

Route::get('/', function () {
    return view('panel');
});

Auth::routes();


Route::get('/encuestas', [EncuestaController::class, 'index'])->name('encuestas.index');
Route::get('/encuestas/create', [EncuestaController::class, 'create'])->name('encuestas.create');
Route::post('/encuestas', [EncuestaController::class, 'store'])->name('encuestas.store');
Route::get('/encuestas/{encuesta}/edit', [EncuestaController::class, 'edit'])->name('encuestas.edit');
Route::put('/encuestas/{encuesta}', [EncuestaController::class, 'update'])->name('encuestas.update');
Route::delete('/encuestas/{encuesta}', [EncuestaController::class, 'destroy'])->name('encuestas.destroy');
