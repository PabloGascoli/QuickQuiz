@extends('layouts.app')

@section('title', 'Editar Encuesta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>Editar Encuesta</h1>

    <form action="{{ route('encuestas.update', ['encuesta' => $encuesta->id_encuesta]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $encuesta->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="genero">Género:</label>
            <select name="genero" id="genero" class="form-control" required>
                <option value="">Seleccione un género</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->id }}" {{ $encuesta->genero == $genero->id ? 'selected' : '' }}>{{ $genero->genero }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required>{{ $encuesta->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Encuesta</button>
    </form>


    <div class="mt-4">
        <a href="{{ route('preguntas.create', ['encuesta' => $encuesta->id_encuesta]) }}" class="btn btn-secondary">Crear Pregunta</a>
    </div>


    <div class="mt-4">
        <h2>Preguntas de la Encuesta</h2>
        <ul class="list-group">
            @foreach($preguntas as $pregunta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Pregunta:</strong> {{ $pregunta->pregunta }}<br>
                        @if($pregunta->imagen)
                            <img src="{{ asset('images/' . $pregunta->imagen) }}" alt="{{ $pregunta->pregunta }}" style="max-height: 100px;">
                        @endif
                        <br>
                        <strong>Tiempo:</strong> {{ $pregunta->tiempo }} segundos
                    </div>
                    <div>
                        <a href="{{ route('preguntas.edit', ['pregunta' => $pregunta->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('preguntas.destroy', ['pregunta' => $pregunta->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
