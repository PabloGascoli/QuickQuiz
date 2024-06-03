<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function create()
    {
        return view('generos.create');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'genero' => 'required|string|max:255|unique:generos',
        ]);

        // Crear un nuevo género
        $genero = new Genero();
        $genero->genero = $request->input('genero');
        $genero->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('encuestas.create')->with('success', 'Género creado exitosamente.');
    }
}