<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\PreguntaController;

Route::get('/', function () {
    return view('menu');
});

Auth::routes();

//Ruta panel de control
Route::get('/panel', [App\Http\Controllers\PanelController::class, 'index'])->name('panel');

// Rutas para géneros
Route::get('/generos/create', [GeneroController::class, 'create'])->name('generos.create');
Route::post('/generos', [GeneroController::class, 'store'])->name('generos.store');
Route::resource('generos', GeneroController::class);

// Rutas para encuestas
Route::resource('encuestas', EncuestaController::class);
Route::get('/', [EncuestaController::class, 'showMenu'])->name('menu');
Route::get('encuestas/{id_encuesta}/estadisticas', [EncuestaController::class, 'estadisticas'])->name('encuestas.estadisticas');



// Rutas para preguntas
Route::get('preguntas/create/{encuesta}', [PreguntaController::class, 'create'])->name('preguntas.create');
Route::post('preguntas', [PreguntaController::class, 'store'])->name('preguntas.store');
Route::get('preguntas/{pregunta}/edit', [PreguntaController::class, 'edit'])->name('preguntas.edit');
Route::put('preguntas/{pregunta}', [PreguntaController::class, 'update'])->name('preguntas.update');
Route::delete('preguntas/{pregunta}', [PreguntaController::class, 'destroy'])->name('preguntas.destroy');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}', [PreguntaController::class, 'show'])->name('preguntas.show');
Route::post('preguntas/{encuesta}/{pregunta}', [PreguntaController::class, 'registrarRespuesta'])->name('preguntas.respuesta');
Route::get('encuestas/{encuesta}/pregunta', [PreguntaController::class, 'primeraPregunta'])->name('preguntas.primera');
Route::get('encuestas/sin_preguntas', [EncuestaController::class, 'sinPreguntas'])->name('encuestas.sin_preguntas');
Route::get('encuestas/{encuesta}/preguntas/{pregunta}/siguiente', [PreguntaController::class, 'siguientePregunta'])->name('preguntas.siguiente');


