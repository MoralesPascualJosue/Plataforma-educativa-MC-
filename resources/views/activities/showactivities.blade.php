<script>
    $("div.alert")
    .not(".alert-important")
    .delay(3000)
    .fadeOut(350);
</script>

@include('flash::message')

<div class="content-tb">

    {{-- @if (count($actividades)) --}}
    @foreach($actividades as $actividad)

    <div class="course-actividad">
        <a href="{{ route('sactivitiec', [$actividad->id]) }}">
            <div class="course-link-icon">
                <img src="{{ asset("resources/icons/home-work-c.svg") }}" alt="grupos">
                @cannot('edit cursos')
                @if ($actividad->entregas)
                <div class="estate-ae"></div>
                @else
                <div class="estate-ae red"></div>
                @endif
                @endcannot
            </div>
            <div class="course-link-details">
                <div class="course-link-name">{{ $actividad->title }} {{ $actividad->fecha_inicio }}
                    @if ($actividad->entregas)
                    <p class="info-ae">
                        Entregas
                        {{$actividad->entregas["entregas"]}}</p>
                    @endif
                </div>
                <div class="course-link-content">Fecha de vencimiento: {{ $actividad->fecha_final }}</div>
            </div>
        </a>
    </div>

    @endforeach
    {{-- @else
    <div>No tienes actividades registradas</div>
    @endif --}}


</div>