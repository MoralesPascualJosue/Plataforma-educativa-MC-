<header class="panel-header">
    <a class="bb-close" href="{{ route("inicio") }}">×</a>

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">
                <span class="course-name">{!! $curso->title !!}</span>

                @can('edit cursos')
                <div class="tools-course canedit">
                    <ul class="course-tools">
                        <li class="course-tool-tab tooltip edit" id="{{ $curso->id }}">
                            <a class="course-tab-content" href="javascript:void(0);">
                                <img src="{{ asset("resources/icons/edit-a.svg") }}" alt="editar">
                            </a>
                            <span class="tooltiptext">Editar</span>
                        </li>
                    </ul>
                </div>
                @endcan

            </h1>
        </div>
    </div>

    <div class="course-nav">
        <ul class="course-tools">

            @cannot('edit cursos')
            <li class="course-tool-tab button-dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle">
                    Notificaciones▼<span class="notificaitons-number">{{ $curso->notificacionesnum }}</span>
                </a>
                <ul class="dropdown-menu">

                    @forelse ($curso->notificaciones as $notificacion)
                    <li>
                        <a href="/sactivitiec/{{ $notificacion->data['activitie'] }}?n={{$notificacion->id}}"
                            class="data-n" id="{{$notificacion->id}}">
                            {{$notificacion->data['title']}}
                            <span class="time-n">{{$notificacion->created_at->diffForHumans()}}</span>
                        </a>
                    </li>
                    @empty
                    <li>
                        <a href="#" class="data-n">
                            Sin notificaciones
                        </a>
                    </li>
                    @endforelse

                    <li>
                        <a href="{{route('leernotificaciones')}}" class="data-n-n">
                            Marcar leidas
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <li class="course-tool-tab {{ Route::is('scursoc') ? 'active' : '' }}">
                <a class=" course-tab-content" href="">
                    <img src="{{ asset("resources/icons/contenido-c.svg") }}" alt="Contenido">
                </a>
            </li>
            <li class="course-tool-tab {{ Route::is('foro') ? 'active' : '' }}">
                <a class=" course-tab-content" href="{{ route("foro",[$curso->id]) }}">
                    <img src="{{ asset("resources/icons/debate-c.svg") }}" alt="Foro">
                </a>
            </li>
            <li class="course-tool-tab {{ Route::is('mensajes') ? 'active' : '' }}">
                <a class=" course-tab-content" href="{{ route("mensajes",$curso->id) }}">
                    <img src="{{ asset("resources/icons/messages-c.svg") }}" alt="Mensajes">
                </a>
            </li>

            @can('edit cursos')
            <li class="course-tool-tab  {{ Route::is('informacion') ? 'active' : '' }}">
                <a class="course-tab-content" href="{{ route("informacion",$curso->id) }}">
                    <img src="{{ asset("resources/icons/libro-calificaciones-c.svg") }}" alt="Informacion">
                </a>
            </li>
            @endcan

        </ul>
    </div>
</header>