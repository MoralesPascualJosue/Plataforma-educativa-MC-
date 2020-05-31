<div class="aside">
    <div class="aside-header">Detalles y acciones</div>

    <div><button class="save btn" id="{{ $activitie->id }}">Guardar</button></div>

    <div class="aside-link">
        <a>
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/list-c.svg") }}" alt="lista">
            </div>
            <div class="aside-link-details">
                <!-- Visible Field -->
                <div class="aside-link-name"><label for="visible">Visible para los estudiante</label></div>
                <div class="aside-link-content">
                    <select id="visible" name="visible">
                        <option value="0" {{ ($activitie->visible == 0) ? 'selected' : '' }}>No</option>
                        <option value="1" {{ ($activitie->visible == 1) ? 'selected' : '' }}>Si</option>
                    </select>
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
                <!-- Intentos Field -->
                <div class="aside-link-name"><label for="intentos">Intentos de entrega</label></div>
                <div class="aside-link-content">
                    <select id="intentos" name="intentos">
                        <option value="1" {{ ($activitie->intentos == 1) ? 'selected' : '' }}>uno</option>
                        <option value="2" {{ ($activitie->intentos == 2) ? 'selected' : '' }}>dos</option>
                        <option value="3" {{ ($activitie->intentos == 3) ? 'selected' : '' }}>tres</option>
                    </select>
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
                <!-- Fecha Inicio Field -->
                <div class="aside-link-name">fecha inicio</div>
                <div class="aside-link-content"><input type="date" id="fecha_inicio" name="fecha_inicio"
                        value="{{$activitie->fecha_inicio }}" onchange="handler(event);"></div>
            </div>
        </a>
    </div>

    <div class="aside-link">
        <a href="javascript:void(0);">
            <div class="aside-link-icon">
                <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
            </div>
            <div class="aside-link-details">
                <!-- Fecha Final Field -->
                <div class="aside-link-name">Fecha de limite de entrega</div>
                <div class="aside-link-content"><input type="date" id="fecha_final" name="fecha_final"
                        min="{{$activitie->fecha_inicio}}" max="" value="{{$activitie->fecha_final }}"></div>
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
                <div class="aside-link-name">Eliminar actividad</div>
                <div class="aside-link-content">se eliminara todo el contenido</div>
            </div>
        </a>
    </div>
    @endcan

    {{-- <div class="ce-example__button" id="saveButton">
        Guardar contenido
    </div> --}}

    <div id="contenidosave"> Cargando </div>
</div>