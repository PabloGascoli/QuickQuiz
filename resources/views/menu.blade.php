@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
<link rel="stylesheet" src="{{ asset('css/menu.css') }}">

<section class="image-text-section">
    <div class="image-wrapper">
        <img src="{{ asset('.\favicon.png') }}" alt="Logo QuickQuiz">
    </div>
    <div class="text-wrapper">
        <p>En QuickQuiz, nos dedicamos a proporcionar una herramienta poderosa y fácil de usar para crear, compartir y analizar encuestas. Ya sea que estés investigando el mercado, recolectando opiniones para mejorar tus productos y servicios, o simplemente buscando conocer mejor a tu audiencia, QuickQuiz es tu solución ideal.</p>
    </div>
</section>

@foreach($generos as $genero)
    @php
        $encuestasGenero = $encuestas->where('genero', $genero->id);
    @endphp

    @if($encuestasGenero->isNotEmpty())
        <section>
            <h2>{{ $genero->genero }}</h2>
            <div id="carousel-{{ $genero->id }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($encuestasGenero->chunk(2) as $index => $encuestasChunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-around align-items-center flex-wrap flex-md-nowrap">
                                @foreach($encuestasChunk as $encuesta)
                                    <div class="d-flex flex-column justify-content-center align-items-center encuesta-item" style="max-width: 45%; margin: 0 10px;">
                                        <a href="{{ route('preguntas.primera', ['encuesta' => $encuesta->id_encuesta]) }}">
                                            <img src="{{ asset('images/' . $encuesta->imagen) }}" class="d-block mb-2" alt="{{ $encuesta->nombre }}" style="max-height: 300px;">
                                            <div>
                                                <h5 class="text-center">{{ $encuesta->nombre }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev custom-carousel-control-prev" href="#carousel-{{ $genero->id }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon custom-carousel-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next custom-carousel-control-next" href="#carousel-{{ $genero->id }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon custom-carousel-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </section>
    @endif
@endforeach

@endsection



