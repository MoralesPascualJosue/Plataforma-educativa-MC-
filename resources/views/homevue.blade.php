<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../resources/logo/Logo minmin white.svg" type="image/svg+xml">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PDEPI') }}</title>
    
   <!-- Scripts -->
    <script src="{{ asset('js/app'.$perfil.'.js') }}" defer></script>
    <!-- Styles -->
   <!--  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<body>
    <div id="app">
        <app></app>
        <flash />
    </div>
</body>
</html>
