<header class="panel-header">

    <a class="bb-close" href="{{ route("scursoc",$curso->id) }}">×</a>

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">
                <span class="course-name"><span class="activitie-name">{{ $curso->title }} </span>
                    <span class="activitie-namec">{{ $activitie->title }}</span>
                </span>
                @can('edit cursos')

                <div class="tools-course canedit">
                    <ul class="course-tools">
                        <li class="course-tool-tab tooltip edit" id="{{ $activitie->id }}">
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

</header>

<header class="panel-header">

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">

                <h3>Contenido @can("edit cursos") <span>y ajustes</span>@endcan</h3>

            </h1>
        </div>
    </div>
    @can("edit cursos")
    <div class="course-nav">
        <ul class="course-tools">
            <li class="course-tool-tab">
                <a class="course-tab-content icono-normal" href="{{route("trabajos",$activitie->id)}}">
                    <span class="button-text">ver Tareas </span>
                    <img src="{{ asset("resources/icons/contenido-c.svg") }}" alt="Tareas">
                </a>
            </li>
        </ul>
    </div>
    @endcan
</header>