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
        <a href="{{ route('activities.show', [$actividad->id]) }}">
            <div class="course-link-icon">
                <img src="{{ asset("resources/icons/home-work-c.svg") }}" alt="grupos">
            </div>
            <div class="course-link-details">
                <div class="course-link-name">{{ $actividad->title }} {{ $actividad->fecha_inicio }}</div>
                <div class="course-link-content">Fecha de vencimiento: {{ $actividad->fecha_final }}</div>
            </div>
        </a>
    </div>

    @endforeach
    {{-- @else
    <div>No tienes actividades registradas</div>
    @endif --}}


</div>