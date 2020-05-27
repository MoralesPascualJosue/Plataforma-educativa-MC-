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

                        <li class="course-tool-tab tooltip delete" id="{{ $curso->id }}">
                            <a class="course-tab-content" href="javascript:void(0)">
                                <img src="{{ asset("resources/icons/delete-a.svg") }}" alt="eliminar">
                            </a>
                            <span class="tooltiptext">Eliminar</span>
                        </li>

                    </ul>
                </div>

                @endcan

            </h1>


        </div>
    </div>

    <div class="course-nav">
        <ul class="course-tools">
            <li class="course-tool-tab active">
                <a class="course-tab-content" href="">
                    <img src="{{ asset("resources/icons/contenido-c.svg") }}" alt="Contenido">
                </a>
            </li>
            <li class="course-tool-tab">
                <a class="course-tab-content" href="">
                    <img src="{{ asset("resources/icons/debate-c.svg") }}" alt="Debates">
                </a>
            </li>
            <li class="course-tool-tab">
                <a class="course-tab-content" href="">
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