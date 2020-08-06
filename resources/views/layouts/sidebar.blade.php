<div class="sidebar-wrapper">
    @if (Auth::guest())
    <h1>Invitado</h1>
    @else

    <div class="header">

        <div class="photo">
            <img src="{{ asset('resources/logo/Logo comp white.svg') }}" />
        </div>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        <p class="site-description">
            <small>Miembro desde {{ Auth::user()->created_at->format('M. Y') }}</small>
        </p>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>

        <nav class="navigation">
            <a id="perfil-nav-a"
                class="nav-link name-u {{ Route::is('perfil') ? 'w--current' : '' }}">{{ Auth::user()->name }}</a>
            <input type="hidden" id="perfil-input" value="{{ Auth::user()->id }}">
            <a href="{{ url('/logout') }}" class="nav-link log-out"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img src="{{ asset('resources/icons/log-out.svg') }}" alt=""> Salir
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @cannot('edit cursos')
            <a id="home-nav-n" class="nav-link {{ Route::is('notificaciones') ? 'w--current' : '' }}">Notificaciones</a>
            @endcan
            <a id="home-nav-a" class="nav-link {{ Route::is('home') ? 'w--current' : '' }}">Inicio</a>
            <a id="clases-nav-a" class="nav-link {{ Route::is('inicio') ? 'w--current' : '' }}">Clases</a>
            <a class="nav-link" href="{{ url('/') }}">VER WEB </a>
            <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        </nav>

        <div class="social-link-group hide-on-medium">
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="{{ asset('resources/social-redes/facebook-icon.svg') }}"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="{{ asset('resources/social-redes/instagram-icon.svg') }}"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="{{ asset('resources/social-redes/twitter-icon.svg') }}"></a>
            <a class="social-icon-link w-inline-block" href="#"><img
                    src="{{ asset('resources/social-redes/linkedin-icon.svg') }}"></a>
            <a class="social-icon-link w-inline-block" href="/contact"><img
                    src="{{ asset('resources/social-redes/correo-icon.svg') }}"></a>
        </div>

    </div>

    @endif
</div>