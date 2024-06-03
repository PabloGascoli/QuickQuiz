@extends('layouts.app')

@section('title', 'Crear Nuevo Género')

@section('content')
<div class="container">
    <h1>Crear Nuevo Género</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('generos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="genero">Nombre del Género:</label>
            <input type="text" name="genero" id="genero" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

