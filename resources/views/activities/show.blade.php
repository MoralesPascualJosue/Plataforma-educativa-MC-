@extends('layouts.activitie')

@section('content')

@include('flash::message')

@can("edit cursos")
<button class="btn-save savebutton" id="{{$activitie->id}}">
    Guardar contenido
</button>
@endcan

<div class="content">

    {!! $task !!}

    @cannot('edit cursos') <h3 class="center"> <span>Entrega</span> </h3>

    <div class="block-s sc">
        <form action="/uploadfilee" id="zonedrop" class="dropzone" method='post'>
            @csrf
            <div class="fallback">
                <input type="file" multiple id="file" name='file' />
            </div>
            <div class="dz-message" data-dz-message><span>Selecciona o arrastra tus archivos aqui.</span></div>
        </form>
        <button type="submit" id="sumit-all" class="btn-sumit-a">Subir</button>
    </div>

    <p>Asegurate de subir todos tus archivos antes de entregar</p>
    <div class="block-s work">

    </div>

    <button class="savebuttone" id="{{$activitie->id}}">
        Entregar
    </button>

    <div class="block-s"></div>

    <h3 class="center"><span>Entregas realizadas</span></h3>

    @foreach($works as $work)
    <hr>
    <hr>
    <div class="block-s archive" name="" id="editorworkv">
        <h1>Entrega {{ $work->entregas }}</h1>
        <br>
        {!! $work->contenido !!}
    </div>
    @endforeach
    @endcannot

</div>
@can('edit cursos')
<div class="newblock">Agregar bloque</div>
@endcan

<script>
    $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>
@endsection