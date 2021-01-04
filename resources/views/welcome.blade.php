<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../resources/logo/Logo minmin white.svg" type="image/svg+xml">

  <title>PDEPI</title>

  <link href="/css/stylesw.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <div class="right-container">
      <div class="book-container">
        <div class="book-tittle">Maestría en construcción</div>
      </div>
      <div class="information-container">
        <div class="information-header">
          Bienvenido a la plataforma en linea
        </div>
        <div class="informacion-content">
          Para acceder al contenido debes registrarte.
        </div>
      </div>
    </div>

    <div class="footer-container">
      <div class="footer">
        <div class="float-right">
          <div class="footer-links">
            <a href="">Acerca de nosotros</a>
          </div>
          <div class="copyright">Copyright © 2020. Maestria en Contrucción. Todos los derechos reservados.</div>
        </div>
      </div>
    </div>

  </div>

  <div>
    <div class="floating-header" role="banner">
      <div class="float-left">
        <img class="logo" alt="MC en linea" src="{{ asset('resources/logo/Logo minmin orange.svg') }}">
        <div class="header-logo-subtitle">DEPI</div>
      </div>
      @if (!Auth::guest())
      <div class="float-right">
        <a href="{{ route('home') }}" class="button header-button" id="homeLink">Home</a>
      </div>
      @else
      <div class="float-right">
        <a href="{{ url('/register') }}" class="button header-button" id="register-link">Registrarse</a>
        <a href="{{ route('login') }}" class="button header-button" id="signinLink">Ingresar</a>
        <a href="" class="button header-button help-button">Ayuda?</a>
      </div>
      @endif
    </div>
  </div>

</body>

</html>