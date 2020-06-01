<header class="panel-header">

    <a class="bb-close" href="{{ route("sactivitiec",$activitie->id) }}">×</a>

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">
                <span class="course-name"><span class="activitie-name" id="{{$activitie->id }}">{{ $curso->title }}
                    </span>
                    <span class="activitie-namec">{{ $activitie->title }}</span>
                </span>
            </h1>
        </div>
    </div>

</header>

<header class="panel-header">

    <div class="panel-titles-container" id="global-title">
        <div class="title-container">
            <h1 class="panel-title">
                <h3>Participantes del curso</h3>
            </h1>
        </div>
    </div>
</header>