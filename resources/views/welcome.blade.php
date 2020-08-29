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
  <div>

    <div class="floating-header" role="banner">
      <div class="float-left">
        <img class="logo" alt="MC en linea" src="{{ asset('resources/logo/Logo minmin white.svg') }}">
        <div class="header-logo-subtitle">Maestria en construccion</div>
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

    <div class="landing">

      <div class="m-section welcome-section" id="m-section">
        <div class="m-header">
          <div class="m-header-text xlarge p-t-20" role="heading">Bienvenido a la plataforma en linea</div>
        </div>
        <div class="m-subsection">
          <div class="float-left">
            <img src="{{ asset('resources/logo/pantalla1-sc.png') }}" alt="Inicio" class="m-image">
          </div>
          <div class="float-right">
            <div class="m-subheading" role="heading">Una forma fácil de enseñar.<br class="hide-on-medium"> Y
              aprender.</div>
            <div class="m-text">
              <p>La actualidad de los cursos en linea.</p>
            </div>
            <a class="button register-button" href="{{ url('/register') }}">Registrate</a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="m-section browser-section">
        <div class="m-header">
          <div class="m-header-text large" role="heading">Ahorra tiempo</div>
          <div class="m-header-text small align-center">Interactua, obten la informacion que necesitas, y maneja tus
            cursos con menos clicks.</div>
        </div>
        <div class="m-subsection">
          <div class="m-browser-image-container align-center">
            <img src="{{ asset('resources/logo/pantalla3-e.png') }}" alt="Clicks">
          </div>
        </div>
      </div>

      <div class="m-section image-right-section">
        <div class="m-subsection">
          <div class="float-left align-middle">
            <div class="m-header">
              <div class="m-header-text large" role="heading">Enseña</div>
              <div class="m-header-text small">
                Realiza fácilmente todas tus actividades desde tu tablet o pc.
              </div>
            </div>
          </div>
          <div class="float-right align-middle">
            <img src="{{ asset('resources/logo/pantalla4-ee.jpg') }}" alt="En dispositivos" class="m-image750">
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="m-section browser-section">
        <div class="m-header">
          <div class="m-header-text large" role="heading">Ofresca una experiencia conectada</div>
          <div class="m-header-text small align-center">Simplifique la enseñanza y el aprendizaje con el entorno de
            aprendizaje digital.</div>
        </div>
        <div class="m-subsection">
          <div class="m-browser-image-container align-center">
          </div>
        </div>
      </div>

    </div>

    <div class="footer" role="contentinfo">
      <div class="float-left">
        <img class="logo" alt="MAE" src="{{ asset('resources/logo/Logo comp orange.svg') }}">
        <div class="footer-logo-subtitle">
          <a href="">Maestria en construccion</a>
        </div>
      </div>
      <div class="float-right">
        <div class="footer-links">
          <a href="">Acerca de nosotros</a>
          <a href="" class="help-button">Necesitas ayuda?</a>
          <a href="">Politicas de privacidad</a>
          <a href="">Terminos de uso</a>
        </div>
        <div class="copyright">Copyright © 2020. Maestria en Contrucción. Todos los derechos reservados.</div>
      </div>
    </div>
  </div>

</body>

</html>