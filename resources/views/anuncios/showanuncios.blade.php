<script>
    $("div.alert")
    .not(".alert-important")
    .delay(3000)
    .fadeOut(350);
</script>

@include('flash::message')

@forelse($anuncios as $anuncio)

<div class="anuncio">

    <div class="tittle-anuncios">
        <img class="anuncio-icon" src="{{ asset('resources/icons/anuncio.svg') }}" alt=" AN" />
        <div id="at-{{ $anuncio->id }}" class="anuncio-texto">{{ $anuncio->anuncio }}</div> <span
            class="text-p">({{ $anuncio->updated_at->diffForHumans() }})</span>
    </div>

    @can('edit anuncios')

    <div class="tools-anuncios">
        <ul class="anuncios-tools">
            <li class="anuncios-tool-tab tooltip edit" id="{{ $anuncio->id }}">
                <a class="anuncios-tab-content" href="javascript:void(0);">
                    <img src="{{ asset("resources/icons/edit-a.svg") }}" alt="Contenido">
                </a>
                <span class="tooltiptext">Editar</span>
            </li>

            <li class="anuncios-tool-tab tooltip delete" id="{{ $anuncio->id }}">
                <a class="anuncios-tab-content" href="javascript:void(0)">
                    <img src="{{ asset("resources/icons/delete-a.svg") }}" alt="Debates">
                </a>
                <span class="tooltiptext">Eliminar</span>
            </li>

        </ul>
    </div>
    @endcan
</div>


@empty

<div class="anuncio">

    <div class="tittle-anuncios">
        <img class="anuncio-icon" src="{{ asset('resources/icons/anuncio.svg') }}" alt=" AN" />
        <div id="at-" class="anuncio-texto">Sin nuevos anuncios</div>
    </div>

</div>
@endforelse