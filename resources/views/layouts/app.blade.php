<html>

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="../resources/logo/Logo minmin white.svg" type="image/svg+xml">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesh.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesc.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/appTest.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"> </script>
    @yield('css')

</head>

<body>
    <div class="limiter">
        @if (!Auth::guest())
        <div class="container100">
            <!-- @include('layouts.sidebar') -->

            <div id="wrap100" class="wrap100">
                <!-- page content -->
                @yield('content')
            </div>

        </div>
        @include('layouts.footer')

        @else

        <div>Invitado</div>
        @yield('invitado')
        @endif

    </div>
    <div id="app">
        <app></app>
        <flash />
    </div>

    <script src="{{ asset('js/appmanager.js') }}"> </script>
    @stack('scripts')
</body>

</html>