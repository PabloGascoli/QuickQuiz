@extends('layouts.app')

@section('title', 'Crear Nueva Encuesta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>Crear Nueva Encuesta</h1>

    <form action="{{ route('encuestas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="genero">Género:</label>
            <div class="input-group">
                <select name="genero" id="genero" class="form-control" required>
                    <option value="">Seleccione un género</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addGeneroModal">Añadir Género</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Encuesta</button>
    </form>
</div>

<div class="modal fade" id="addGeneroModal" tabindex="-1" role="dialog" aria-labelledby="addGeneroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGeneroModalLabel">Añadir Género</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addGeneroForm" action="{{ route('generos.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nuevo_genero">Nombre del Género:</label>
                        <input type="text" name="genero" id="nuevo_genero" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
