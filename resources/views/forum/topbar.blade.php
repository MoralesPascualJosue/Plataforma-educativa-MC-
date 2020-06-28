<header class="panel-header">

    <a class="bb-close" href="{{ route("scursoc",$curso->id) }}">×</a>

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">
                <span class="course-name">{!! $curso->title !!}</span>
            </h1>

        </div>
    </div>

    <div class="course-nav">
        <ul class="course-tools">
            <li class="course-tool-tab {{ Route::is('scursoc') ? 'active' : '' }}">
                <a class="course-tab-content" href="{{ route("scursoc",$curso->id) }}">
                    <img src="{{ asset("resources/icons/contenido-c.svg") }}" alt="Contenido">
                </a>
            </li>
            <li class="course-tool-tab  {{ Route::is('foro') ? 'active' : '' }}">
                <a class="course-tab-content" href="{{ route("foro",$curso->id) }}">
                    <img src="{{ asset("resources/icons/debate-c.svg") }}" alt="Foro">
                </a>
            </li>
            <li class="course-tool-tab {{ Route::is('chats') ? 'active' : '' }}">
                <a class="course-tab-content" href="{{ route("chats",$curso->id) }}">
                    <img src="{{ asset("resources/icons/messages-c.svg") }}" alt="Mensajes">
                </a>
            </li>
            <li class="course-tool-tab">
                <a class="course-tab-content" href="">
                    <img src="{{ asset("resources/icons/libro-calificaciones-c.svg") }}" alt="Calificaciones">
                </a>
            </li>
        </ul>
    </div>
</header>