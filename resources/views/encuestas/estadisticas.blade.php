@extends('layouts.app')

@section('title', 'Estadísticas de la Encuesta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>Estadísticas de la Encuesta: {{ $encuesta->nombre }}</h1>

    @if($preguntas && $preguntas->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Sí (%)</th>
                    <th>No (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->si + $pregunta->no > 0 ? round(($pregunta->si / ($pregunta->si + $pregunta->no)) * 100, 2) : 0 }}%</td>
                    <td>{{ $pregunta->si + $pregunta->no > 0 ? round(($pregunta->no / ($pregunta->si + $pregunta->no)) * 100, 2) : 0 }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No hay preguntas disponibles para esta encuesta.</p>
    @endif
    <a href="{{ route('menu') }}" class="btn btn-primary mt-3">Volver al Menú</a>
</div>
@endsection
