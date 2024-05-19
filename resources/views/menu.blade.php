@extends('layouts.app')

@section('title', 'Página de Inicio')

@section('content')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <section>
        <p>Aquí puedes poner tu texto.</p>
        <div>
            <button>Botón 1</button>
            <button>Botón 2</button>
        </div>
    </section>

    <!-- Segunda Sección con Carrusel de Imágenes -->
    <section>
        <h2>Encuestas</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <!-- Aquí se generarán los indicadores del carrusel -->
            </ol>
            <div class="carousel-inner">
                <!-- Aquí se colocarán las imágenes del carrusel -->
                <div class="carousel-item active">
                    <img src="imagen1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="imagen2.jpg" class="d-block w-100" alt="...">
                </div>
                <!-- Puedes agregar más imágenes siguiendo esta estructura -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </section>

@endsection