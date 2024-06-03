@extends('layouts.app')

@section('title', 'Crear Pregunta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>Crear Pregunta para la Encuesta: {{ $encuesta->nombre }}</h1>

    <form action="{{ route('preguntas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="pregunta">Texto de la Pregunta:</label>
            <input type="text" name="pregunta" id="pregunta" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="form-group">
            <label for="tiempo">Tiempo (segundos):</label>
            <input type="number" name="tiempo" id="tiempo" class="form-control" required>
        </div>

        <input type="hidden" name="id_encuesta" value="{{ $encuesta->id_encuesta }}">

        <button type="submit" class="btn btn-primary">Crear Pregunta</button>
    </form>
</div>
@endsection
