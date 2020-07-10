<div class="aside">
    <div class="aside-header">Detalles y acciones</div>
    <div class="container2">
        <ul class="ks-cboxtags">
            <li>
                <input type="checkbox" id="mostrar" {{ ($activitie->visible == 1) ? 'checked' : '' }}>
                <label for="mostrar">Visible</label>
            </li>
        </ul>
    </div>

    <div class='ctrl'>
        <div class='ctrl__button ctrl__button--decrement'>&ndash;</div>
        <div class='ctrl__counter'>
            <p class="intentoslabel"> Intentos </p>
            <input class='ctrl__counter-input' maxlength='10' type='text' value='1'>
            <div class='ctrl__counter-num'>{{ $activitie->intentos }}</div>
        </div>
        <div class='ctrl__button ctrl__button--increment'>+</div>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-details">
                <!-- Fecha Inicio Field -->
                <div class="aside-link-content"><input type="date" id="fecha_inicio" name="fecha_inicio"
                        value="{{$activitie->fecha_inicio }}" onchange="handler(event);"></div>
                <div class="aside-link-name">fecha inicio</div>
            </div>
        </a>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-details">
                <!-- Fecha Final Field -->
                <div class="aside-link-content"><input type="date" id="fecha_final" name="fecha_final"
                        min="{{$activitie->fecha_inicio}}" max="" value="{{$activitie->fecha_final }}"></div>
                <div class="aside-link-name">Fecha limite</div>
            </div>
        </a>
    </div>

    @can('edit cursos')
    <div class="aside-link delete" id="{{ $activitie->id }}">
        <a href="javascript:void(0);">
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/delete-a.svg") }}" alt="eliminarc">
            </div>
            <div class="aside-link-details">
                <div class="aside-link-content">Eliminar actividad</div>
                <div class="aside-link-content">se eliminara todo el contenido</div>
            </div>
        </a>
    </div>
    @endcan
    <div><button class="aside-header save btn" id="{{ $activitie->id }}">Guardar</button></div>
</div>