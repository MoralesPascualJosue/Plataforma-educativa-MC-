<!DOCTYPE html>
<html id="all">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="http://localhost:8000/resources/logo/Logo minmin white.svg" type="image/svg+xml">

    <title>@yield('title')</title>
    @can('edit cursos')
    <link rel="stylesheet" href="{{ asset('css/stylesa.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/stylesae.css') }}">
    @endcan

    {{-- <link rel="stylesheet" href="{{ asset('css/deditor.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('js/dropzone/dropzone.min.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('videojs/video-js.min.css') }}">
    @yield('css')

    <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"> </script>
</head>

<body>
    <div class="limiter">
        @if (!Auth::guest())
        <div class="container100">
            <!-- Left side column. contains the logo and sidebar -->
            @include('activities.topbar')
            <!-- Down side. Main Footer-->
            <div class="container">
                <div class="menud">
                    <div>Eliminar</div>
                    <div class="menud-option menud-option-confirmar" id="">Si</div>
                    <div class="menud-option menud-option-cancel">No</div>
                </div>
                <div class="item1">
                    @can('edit cursos')
                    @include('activities.toolsidebar')
                    @else
                    @include('activities.statussidebar')
                    @endcan
                </div>
                <div id="wrap100" class="wrap100 item2">
                    <!-- Contains page content -->
                    @yield('content')
                </div>
            </div>
        </div>

        @else
        <div>Invitado</div>
        @yield('invitado')

        @endif
    </div>

    <script src="{{ asset('js/activitiemanager.js') }}"> </script>

    {{-- <script src="{{ asset('editor/embed-block.js') }}"> </script>
    <script src="{{ asset('editor/header-block.js') }}"> </script>
    <script src="{{ asset('editor/marker-inline.js') }}"> </script>
    <script src="{{ asset('editor/raw-block.js') }}"> </script>
    <script src="{{ asset('editor/table-block.js') }}"> </script>
    <script src="{{ asset('editor/code-inline.js') }}"> </script>
    <script src="{{ asset('editor/paragraph-block.js') }}"> </script>
    <script src="{{ asset('editor/simple-image-block.js') }}"> </script>
    <script src="{{ asset('editor/attaches-block.js') }}"> </script>
    <script src="{{ asset('editor/personality-block.js') }}"> </script>
    <script src="{{ asset('editor/quote-block.js') }}"> </script>
    <script src="{{ asset('editor/list-block.js') }}"> </script>
    <script src="{{ asset('editor/warning-block.js') }}"> </script>
    <script src="{{ asset('editor/code-block.js') }}"> </script>
    <script src="{{ asset('editor/checklist-block.js') }}"> </script>
    <script src="{{ asset('editor/delimiter-block.js') }}"> </script>

    <script src="{{ asset('editor/image-block.js') }}"> </script>
    <script src="{{ asset('editor/editor.js') }}"> </script>
    <script src="{{ asset('editor/editorup.js') }}"> </script> --}}

    {{-- <script src="{{ asset('js/dropzone/dropzone.min.js') }}"> </script> --}}
    <script src="{{ asset('videojs/video.min.js') }}"> </script>
    {{-- <script src="{{ asset('js/ckfinder/ckfinder.js') }}"> </script>
    <script>
        CKFinder.config( { connectorPath: '/ckfinder/connector' } );
    </script>
    <script src="{{ asset('ckeditor/ckeditor5 1/build/ckeditor.js') }}"> </script> --}}

    @can('edit cursos')
    <script src="{{ asset('js/ck.js') }}"> </script>
    @else
    <script src="{{ asset('js/cke.js') }}"> </script>
    @endcan

    @stack('scripts')
</body>

</html>