<!DOCTYPE html>
<html id="all">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/stylesa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/deditor.css') }}">
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
            @can('edit cursos')
            @include('activities.toolsidebar')
            @else
            @include('activities.statussidebar')
            @endcan

            <div id="wrap100" class="wrap100">
                <!-- Contains page content -->
                @yield('content')
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

    @stack('scripts')
</body>

</html>