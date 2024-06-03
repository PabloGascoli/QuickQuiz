<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\Genero;

class EncuestaController extends Controller
{
    public function index()
    {
        $encuestas = Encuesta::with('generoRelacion')->get();
        return view('panel', compact('encuestas'));
    }
    public function showMenu()
    {
        $generos = Genero::all();
        $encuestas = Encuesta::with('generoRelacion')->get();
        return view('menu', compact('encuestas', 'generos'));
    }

    public function create()
    {
        $generos = Genero::all();
        return view('encuestas.create', compact('generos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'genero' => 'required|exists:generos,id',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imageName = time() . '.' . $request->imagen->extension();  
        $request->imagen->move(public_path('images'), $imageName);

        Encuesta::create([
            'nombre' => $request->nombre,
            'genero' => $request->genero,
            'descripcion' => $request->descripcion,
            'imagen' => $imageName,
        ]);

        return redirect()->route('encuestas.index')->with('success', 'Encuesta creada exitosamente');
    }

    public function edit(Encuesta $encuesta)
    {
        $generos = Genero::all();
        $preguntas = $encuesta->preguntas;

        return view('encuestas.edit', compact('encuesta', 'generos', 'preguntas'));
    }

    public function update(Request $request, Encuesta $encuesta)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'genero' => 'required|exists:generos,id',
        'descripcion' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->only(['nombre', 'genero', 'descripcion']);

    if ($request->hasFile('imagen')) {
        $imageName = time() . '.' . $request->imagen->extension();
        $request->imagen->move(public_path('images'), $imageName);
        $data['imagen'] = $imageName;
    }

    $encuesta->update($data);

    return redirect()->route('encuestas.index')->with('success', 'Encuesta actualizada exitosamente');
}


    public function destroy(Encuesta $encuesta)
    {
        $encuesta->delete();
        return redirect()->route('encuestas.index');
    }
    
    public function estadisticas($id_encuesta)
    {
        $encuesta = Encuesta::findOrFail($id_encuesta);
        $preguntas = $encuesta->preguntas;

        return view('encuestas.estadisticas', compact('encuesta', 'preguntas'));
    }
}
