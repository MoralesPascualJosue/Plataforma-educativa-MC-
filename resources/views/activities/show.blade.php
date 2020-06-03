@extends('layouts.activitie')

@section('content')

<script>
    $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>

@include('flash::message')

<div class="content">

    <!-- Contenido Field -->
    <div>
        <textarea id="editor" name="contenido">{{ $task }}</textarea>
    </div>
    <br>

    @can("edit cursos")
    <button class="ce-example__button savebutton" id="{{$activitie->id}}">
        Guardar
    </button>
    @endcan

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

    {{-- <video width="640" height="360" controls>
        <source
            src="http://192.168.1.70:8000/userfiles/users/files/pruebaAnalogiPorts%20-%20Proteus%208%20Professional.mp4"
            type="video/mp4">
        Tu navegador no soporta HTML5 video.
    </video>
    <Button class="btn" id="add"> add</Button>

    <form action="/activitiepost/12" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
    <input type="file" name="file">
    <button type="submit">Upload</button>
    </form>

    <form action="/uploadfile/12" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile"
                aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not
                be
                more than 2MB.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}
</div>

@endsection

@push('scripts')

@endpush