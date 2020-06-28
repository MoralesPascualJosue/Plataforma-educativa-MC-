<!DOCTYPE html>
<html id="all">

<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/stylesci.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesch.css') }}">
    @yield('css')

    <script src="{{asset('js/jquery/jquery-3.5.1.min.js')}}"> </script>
</head>

<body>
    <div class="limiter">
        @if (!Auth::guest())

        <div class="container100">
            @include('forum.topbar')

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

    <script src="{{ asset("js/chatmanager.js") }}"> </script>

    @stack('scripts')
</body>

</html>