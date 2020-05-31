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

    @cannot('edit cursos')
    <div>
        <textarea id="editorwork" name="contenidowork"></textarea>
    </div>
    @endcan
    {{-- <div class="contenido" id="editorjs">
        <p>contenido</p>
    </div> --}}

    {{-- <video width="640" height="360" controls>
        <source
            src="http://localhost:8000/userfiles/files/Entregas%20seminario%201/pruebaAnalogiPorts%20-%20Proteus%208%20Professional.mp4"
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
<script src="{{ asset('ckeditor/ckfinder/ckfinder.js') }}"> </script>
<script>
    CKFinder.config( { connectorPath: '/ckfinder/connector' } );
</script>
<script src="{{ asset('ckeditor/ckeditor5 1/build/ckeditor.js') }}"> </script>

@can('edit cursos')
<script src="{{ asset('js/ck.js') }}"> </script>
@else
<script src="{{ asset('js/cke.js') }}"> </script>
@endcan



@endpush