<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;

class EncuestaController extends Controller
{
    // Método para mostrar todas las encuestas
    
    public function index()
    {
        $encuestas = Encuesta::all();
        return view('panel', ['encuestas' => $encuestas]);
    }

    // Método para mostrar el formulario de creación de encuestas
    public function create()
    {
        return view('encuestas.create');
    }

    // Método para guardar una nueva encuesta
    public function store(Request $request)
    {
        // Valida los datos de la solicitud
        $request->validate([
            'nombre' => 'required',
            'genero' => 'required',
            'descripcion' => 'required',
            // Añade las reglas de validación para otros campos aquí
        ]);

        // Crea una nueva instancia de Encuesta con los datos recibidos
        Encuesta::create($request->all());

        // Redirige de vuelta a la página de gestión de encuestas
        return redirect()->route('encuestas.index');
    }

    // Método para mostrar el formulario de edición de encuestas
    public function edit(Encuesta $encuesta)
    {
        return view('encuestas.edit', compact('encuesta'));
    }

    // Método para actualizar una encuesta existente
    public function update(Request $request, Encuesta $encuesta)
    {
        // Valida los datos de la solicitud
        $request->validate([
            'nombre' => 'required',
            'genero' => 'required',
            'descripcion' => 'required',
            // Añade las reglas de validación para otros campos aquí
        ]);

        // Actualiza la encuesta con los datos recibidos
        $encuesta->update($request->all());

        // Redirige de vuelta a la página de gestión de encuestas
        return redirect()->route('encuestas.index');
    }

    // Método para eliminar una encuesta
    public function destroy(Encuesta $encuesta)
    {
        // Elimina la encuesta
        $encuesta->delete();

        // Redirige de vuelta a la página de gestión de encuestas
        return redirect()->route('encuestas.index');
    }
}
