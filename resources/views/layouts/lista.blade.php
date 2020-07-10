<!DOCTYPE html>
<html id="all">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="http://localhost:8000/resources/logo/Logo minmin white.svg" type="image/svg+xml">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/stylesl.css') }}">
    @yield('css')

    <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"> </script>
</head>

<body>
    <div class="limiter">
        @if (!Auth::guest())
        <div class="container100">
            <!-- Left side column. contains the logo and sidebar -->
            @include('works.topbar')

            <!-- Down side. Main Footer-->
            {{-- @can('edit cursos')
            @include('activities.toolsidebar')
            @else --}}


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

    <script src="{{ asset('ckeditor/ckeditor5 1/build/ckeditor.js') }}"> </script>
    <script src="{{ asset('js/listamanager.js') }}"> </script>

    @stack('scripts')
</body>

</html>