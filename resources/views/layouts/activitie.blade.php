<!DOCTYPE html>
<html id="all">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="../resources/logo/Logo minmin white.svg" type="image/svg+xml">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('js/jquery/jquery.sweet-modal.min.css') }}">
    <link rel="stylesheet" href="{{ asset('videojs/video-js.min.css') }}">
    @can('edit cursos')
    <link rel="stylesheet" href="{{ asset('css/stylesa.css') }}">
    @else
    <link rel="stylesheet" href="{{asset('js/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/stylesae.css') }}">
    @endcan
    @yield('css')

    <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"> </script>
</head>

<body>
    <div class="limiter">
        @if (!Auth::guest())
        <div class="container100">
            @include('activities.topbar')
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
                    <!-- page content -->
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
    <script src="{{ asset('videojs/video.min.js') }}"> </script>
    <script src="{{asset('js/jquery/jquery.sweet-modal.min.js')}}"> </script>

    @can('edit cursos')
    <script src="{{ asset('js/ck.js') }}"> </script>
    @else
    <script src="{{ asset('js/dropzone/dropzone.min.js') }}"> </script>
    <script src="{{ asset('js/cke.js') }}"> </script>
    @endcan

    @stack('scripts')
</body>

</html>