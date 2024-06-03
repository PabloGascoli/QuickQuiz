@extends('layouts.app')

@section('title', 'Responder Pregunta')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container text-center">
    <h1 class="display-4">{{ $encuesta->nombre }}</h1>
    <div class="mt-5">
        @if($pregunta->imagen)
            <div class="mb-4">
                <img src="{{ asset('images/' . $pregunta->imagen) }}" alt="{{ $pregunta->pregunta }}" class="img-fluid" style="max-height: 300px;">
            </div>
        @endif
        <h3 id="pregunta-texto" class="mb-4">{{ $pregunta->pregunta }}</h3>
        <div class="mb-4">
            <span id="contador" data-siguiente-url="{{ route('preguntas.siguiente', ['encuesta' => $encuesta->id_encuesta, 'pregunta' => $pregunta->id]) }}" style="font-size: 2rem; color: red;">{{ $pregunta->tiempo }}</span> segundos restantes
        </div>
        <form id="respuesta-form" action="{{ route('preguntas.respuesta', ['encuesta' => $encuesta->id_encuesta, 'pregunta' => $pregunta->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="tiempo_expirado" id="tiempo_expirado" value="0">
            <div class="row justify-content-center">
                <div class="col-10 col-md-5 mb-3">
                    <button type="submit" name="respuesta" value="si" class="btn btn-success btn-lg w-100">Sí</button>
                </div>
                <div class="col-10 col-md-5 mb-3">
                    <button type="submit" name="respuesta" value="no" class="btn btn-danger btn-lg w-100">No</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/timer.js') }}"></script>
@endsection

@section('styles')
<style>
    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.5rem;
    }
</style>
@endsection

