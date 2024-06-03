<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Encuesta;

class PreguntaController extends Controller
{
    public function create($id_encuesta)
    {
        $encuesta = Encuesta::findOrFail($id_encuesta);
        return view('preguntas.create', compact('encuesta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tiempo' => 'required|integer',
            'id_encuesta' => 'required|exists:encuestas,id_encuesta'
        ]);

        $imageName = null;
        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images'), $imageName);
        }

        Pregunta::create([
            'pregunta' => $request->pregunta,
            'imagen' => $imageName,
            'tiempo' => $request->tiempo,
            'id_encuesta' => $request->id_encuesta
        ]);

        return redirect()->route('encuestas.index')->with('success', 'Pregunta creada exitosamente');
    }
    
    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        return view('preguntas.edit', compact('pregunta'));
    }

    public function destroy($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->delete();
        return redirect()->back()->with('success', 'Pregunta eliminada exitosamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pregunta' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tiempo' => 'required|integer|min:1',
        ]);

        $pregunta = Pregunta::findOrFail($id);

        $pregunta->pregunta = $request->input('pregunta');
        $pregunta->tiempo = $request->input('tiempo');

        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images'), $imageName);
            $pregunta->imagen = $imageName;
        }

        $pregunta->save();

        return redirect()->route('encuestas.edit', $pregunta->id_encuesta)->with('success', 'Pregunta actualizada correctamente.');
    }
    
    public function primeraPregunta($encuesta_id)
    {
        $encuesta = Encuesta::findOrFail($encuesta_id);
        $pregunta = Pregunta::where('id_encuesta', $encuesta_id)->orderBy('id')->first();

        if ($pregunta) {
            return redirect()->route('preguntas.show', ['encuesta' => $encuesta_id, 'pregunta' => $pregunta->id]);
        } else {
            return view('encuestas.sin_preguntas', compact('encuesta'));
        }
    }

    public function show($encuesta_id, $pregunta_id)
    {
        $encuesta = Encuesta::findOrFail($encuesta_id);
        $pregunta = Pregunta::findOrFail($pregunta_id);
        
        return view('preguntas.show', compact('encuesta', 'pregunta'));
    }

    public function respuesta(Request $request, $encuesta_id, $pregunta_id)
    {
        $encuesta = Encuesta::findOrFail($encuesta_id);
        $pregunta = Pregunta::findOrFail($pregunta_id);

        $respuesta = $request->input('respuesta'); // 'si' o 'no'

        $siguientePregunta = Pregunta::where('id_encuesta', $encuesta_id)
            ->where('id', '>', $pregunta_id)
            ->orderBy('id')
            ->first();

        if ($siguientePregunta) {
            return redirect()->route('preguntas.show', ['encuesta' => $encuesta_id, 'pregunta' => $siguientePregunta->id]);
        } else {
            return view('encuestas.completada');
        }
    }
    public function registrarRespuesta(Request $request, Encuesta $encuesta, Pregunta $pregunta)
    {
        $respuesta = $request->input('respuesta');
        $tiempoExpirado = $request->input('tiempo_expirado');

        if ($tiempoExpirado == '0') {
            if ($respuesta == 'si') {
                $pregunta->increment('si');
            } elseif ($respuesta == 'no') {
                $pregunta->increment('no');
            }
        }

        // Obtener la siguiente pregunta
        $proximaPregunta = $encuesta->preguntas()
                                    ->where('id', '>', $pregunta->id)
                                    ->orderBy('id')
                                    ->first();

        if ($proximaPregunta) {
            return redirect()->route('preguntas.show', ['encuesta' => $encuesta->id_encuesta, 'pregunta' => $proximaPregunta->id]);
        } else {
            return view('encuestas.completada', compact('encuesta'));
        }
    }
    
    public function siguientePregunta(Encuesta $encuesta, Pregunta $pregunta)
    {
        $siguientePregunta = Pregunta::where('id_encuesta', $encuesta->id)
                                    ->where('id', '>', $pregunta->id)
                                    ->orderBy('id')
                                    ->first();

        if (!$siguientePregunta) {
            return view('encuestas.completada', compact('encuesta'));
        }

        return redirect()->route('preguntas.mostrar', ['encuesta' => $encuesta->id_encuesta, 'pregunta' => $siguientePregunta->id]);
    }

}
