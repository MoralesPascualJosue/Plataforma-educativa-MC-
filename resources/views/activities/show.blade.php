@extends('layouts.activitie')

@section('content')

<script>
    $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>

@include('flash::message')

@can("edit cursos")
<button class="btn-save savebutton" id="{{$activitie->id}}">
    Guardar contenido
</button>
@endcan

<div class="content">

    {!! $task !!}

    @cannot('edit cursos')
    <h3 class="center"> <span>Entrega</span> </h3>

    <div class="block-s sc">
        <form class='input-area' action='/uploadfile' method='post' enctype='multipart/form-data'>
            "<div class='form-group'><input type='file' class='form-control-file' name='fileToUpload'
                    id='exampleInputFile' aria-describedby='fileHelp'>
                <small id='fileHelp' class='form-text text-muted'>Selecciona un archivo Tamaño máximo
                    30MB</small><button type='submit' class='btn-block'>Cargar archivo</button>
                <div class='progress'></div>
            </div>
        </form>
    </div>

    <div class="block-s work">

    </div>

    <button class="savebuttone" id="{{$activitie->id}}">
        Entregar
    </button>


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
    @endcan


    {{-- <div class="contenido" id="editorjs">
        <p>contenido</p>
    </div> --}}
</div>
@can('edit cursos')
<div class="newblock">New Block</div>
@endcan
@endsection