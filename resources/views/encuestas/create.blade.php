@extends('layouts.app')

@section('title', 'Crear Nueva Encuesta')

@section('content')
<div class="container">
    <h1>Crear Nueva Encuesta</h1>

    <form action="{{ route('encuestas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="genero">Género:</label>
            <input type="text" name="genero" id="genero" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
        </div>


        <button type="submit" class="btn btn-primary">Crear Encuesta</button>
    </form>
</div>
@endsection