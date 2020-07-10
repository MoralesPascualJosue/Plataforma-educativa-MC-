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
<button class="btn-save" id="{{$activitie->id}}">
    Guardar contenido
</button>
@endcan

<div class="content">

    {!! $task !!}

    @cannot('edit cursos')

    <div class="work">
        <h3>--- <span>Entrega</span> ---</h3>

        <textarea id="editorwork" name="contenidowork"></textarea>
    </div>

    <button class="ce-example__button savebutton" id="{{$activitie->id}}">
        Entregar
    </button>

    <textarea class="vista" name="" id="editorworkv">
            Entregas realizadas
            
            @foreach($works as $work)
            <hr><hr>
            <br>
            <h1>Entrega {{ $work->entregas }}</h1>                        
            <br>
            {{$work->contenido}}
            @endforeach
        </textarea>
    @endcan


    {{-- <div class="contenido" id="editorjs">
        <p>contenido</p>
    </div> --}}
</div>

<div class="newblock">New Block</div>
@endsection