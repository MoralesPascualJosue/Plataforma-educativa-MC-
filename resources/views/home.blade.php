@extends('layouts.app')


@section('title', 'Inicio')

@section('css')
@endsection

@section('content')

<div class="banner">
    <h2 class="banner-tittle"><span class="banner-ttitle-text">Maestria en contruccion</span></h2>
</div>

<h3 class="subheader-tittle">Anuncios</h3>

@can('edit anuncios')
<div class="tools-anuncios-out">

    <li class="anuncios-tool-tab tooltip create">
        <a class="anuncios-tab-content" href="javascript:void(0);">
            <img src="{{ asset("resources/icons/crear-a.svg") }}" alt="Debates">
        </a>
        <span class="tooltiptext">Crear anuncio</span>
    </li>
    <li class="anuncios-tool-tab create-input">
        <!-- Anuncio Field -->
        <div class="anuncions-tab-content">
            {!! Form::label('anuncio', 'Crear anuncio:') !!}
            {!! Form::text('anuncio', null, ['class' => 'form-control input100', 'placeholder'=> 'Nuevo anuncio']) !!}
        </div>
    </li>

</div>
@endcan

<div id="anuncios" class="anuncios">
    @include('anuncios.showanuncios')
</div>

<div id="anunciosprueba"></div>
<h3 class="subheader-tittle">Mision maestria en construccion</h3>

<div class="anuncios">
    <div class="content-mensaje">
        <div class="content-img-mision"><img alt="Mision imagen" class="img-decoration"
                src="{{ asset('resources/img-msg100.jpg') }}"></div>
        <span class="mensaje-texto">Formar recursos humanos de alto nivel profesional que logren proponer soluciones
            adecuadas y favorables a las
            necesidades que demanda la construcción de obras de infraestructura para el bienestar de nuestro
            Estado.</span>
    </div>
</div>
@endsection

@push('scripts')
@endpush