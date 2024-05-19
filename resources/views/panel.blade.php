@extends('layouts.app')

@section('title', 'Gestión de Encuestas')

@section('content')
<div class="container">
    <h1>Gestión de Encuestas</h1>

    <!-- Botón para crear una nueva encuesta -->
    <a href="{{ route('encuestas.create') }}" class="btn btn-primary mb-3">Crear Nueva Encuesta</a>

    @if(isset($encuestas) && is_array($encuestas) && count($encuestas) > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($encuestas as $encuesta)
                <tr>
                    <td>{{ $encuesta->nombre }}</td>
                    <td>{{ $encuesta->genero }}</td>
                    <td>{{ $encuesta->descripcion }}</td>
                    <td>
                        <a href="{{ route('encuestas.edit', $encuesta->id_encuesta) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('encuestas.destroy', $encuesta->id_encuesta) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer borrar esta encuesta?')">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @elseif(isset($encuestas) && is_array($encuestas) && count($encuestas) === 0)
    <p>No hay encuestas disponibles.</p>
    @else
    <p>No se pudo obtener la lista de encuestas.</p>
    @endif
</div>
@endsection