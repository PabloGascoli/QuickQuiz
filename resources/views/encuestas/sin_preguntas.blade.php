@extends('layouts.app')

@section('title', 'Encuesta sin Preguntas')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container">
    <h1>{{ $encuesta->nombre }}</h1>
    <p>Esta encuesta aún no tiene preguntas creadas.</p>
    <a href="{{ route('menu') }}" class="btn btn-primary">Volver al Menú</a>
</div>
@endsection