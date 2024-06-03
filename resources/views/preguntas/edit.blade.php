@extends('layouts.app')

@section('title', 'Editar Pregunta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>Editar Pregunta</h1>

    <form action="{{ route('preguntas.update', ['pregunta' => $pregunta->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pregunta">Texto de la Pregunta:</label>
            <input type="text" name="pregunta" id="pregunta" class="form-control" value="{{ $pregunta->pregunta }}" required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen actual:</label>
            @if($pregunta->imagen)
                <div>
                    <img src="{{ asset('images/' . $pregunta->imagen) }}" alt="{{ $pregunta->pregunta }}" style="max-height: 150px;">
                </div>
            @else
                <p>No hay imagen disponible</p>
            @endif
        </div>

        <div class="form-group">
            <label for="imagen">Cambiar Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="form-group">
            <label for="tiempo">Tiempo (segundos):</label>
            <input type="number" name="tiempo" id="tiempo" class="form-control" value="{{ $pregunta->tiempo }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Pregunta</button>
    </form>
</div>
@endsection
