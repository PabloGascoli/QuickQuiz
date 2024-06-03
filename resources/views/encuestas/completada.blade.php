@extends('layouts.app')

@section('title', 'Encuesta Completada')

@section('content')
<link rel="stylesheet" href="{{ asset('css/panel.css') }}">
<div class="container text-center">
    <h1>¡Has completado la encuesta!</h1>
    <p>Gracias por participar.</p>
    <a href="{{ route('menu') }}" class="btn btn-primary">Volver al Menú</a>
</div>
@endsection
