<div class="aside">
    <div class="aside-header">Detalles</div>

    <div class="aside-link">
        <a>
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/list-c.svg") }}" alt="lista">
            </div>
            <div class="aside-link-details">
                <!-- Visible Field -->
                <div class="aside-link-name">Entregas permitidas</div>
                <div class="aside-link-content">
                    {{$activitie->intentos}}
                </div>
            </div>

        </a>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
            </div>
            <div class="aside-link-details">
                <div class="aside-link-name">fecha limite</div>
                <div class="aside-link-content">
                    {{$activitie->fecha_final}}
                </div>
            </div>
        </a>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
            </div>
            <div class="aside-link-details">
                <div class="aside-link-name">Calificacion</div>
                <div class="aside-link-content">
                    {{ ($qualification['estado'] == 1) ? 'En revision' : $qualification['qualification'] }}
                </div>
            </div>
        </a>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
            </div>
            <div class="aside-link-details">
                <div class="aside-link-name">Observaciones</div>
                <div class="aside-link-content">{{ $qualification['observaciones'] }}</div>
            </div>
        </a>
    </div>
</div>