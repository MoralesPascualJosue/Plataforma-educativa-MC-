@extends('layouts.lista')

@section('content')
<section class="content-header">

</section>

<div class="content">
    <section class="list-wrap">

        <label for="search-text">Buscar en la lista</label>
        <input type="text" id="search-text" placeholder="Buscar" class="search-box">
        <span class="list-count"></span>


        <ul id="list">
            @foreach ($estudiantes as $estudiante)
            <li class="in">
                <p>{{$estudiante->name}}</p>
                <th><button class="btn entregarev" href="javascript:void(0);"
                        id="{{ $estudiante->id }}">Revisar</button>
                </th>
                <th>{{ ($estudiante->qualificationestado == 1) ? 'Para revision' : $estudiante->qualificationqualification }}
                </th>
            </li>
            @endforeach
            <span class="empty-item">sin resultados</span>
        </ul>
    </section>

    <section class="seccionToggle">
        <div class="wrap">
            <div class="back-c">Cerrar</div>
            <p class="subtitle">Entregas realizadas</p>
            <p class="po">
                <textarea name="observaciones" class="observaciones" id="{{ $activitie->id }}" rows="10"></textarea>
                <span>Calificación</span> <span id="{{ $activitie->id }}" class="calificacion">Pendiente</span>
                <button id="saves" class="btn"> Guardar </button>
            </p>

            <div class="vista">
                @foreach($works as $work)
                <hr>
                <hr>
                <br>
                <h1>Entrega {{ $work->entregas }}</h1>
                <br>
                {!! $work->contenido !!}
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection