<div class="aside">
    <div class="aside-header">Detalles</div>

    <div class="aside-link">
        <a>
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/list-c.svg") }}" alt="lista">
            </div>
            <div class="aside-link-details">
                <!-- Visible Field -->
                <div class="aside-link-name">Entregas</div>
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
                <div class="aside-link-content">80</div>
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
                <div class="aside-link-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. A id iste eaque
                    explicabo aliquid porro ipsum ullam dolorem! Eaque architecto deserunt mollitia enim quis nemo neque
                    quam omnis voluptas rerum?</div>
            </div>
        </a>
    </div>
</div>