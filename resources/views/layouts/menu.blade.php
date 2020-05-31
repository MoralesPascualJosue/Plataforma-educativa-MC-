<li class="{{ Request::is('asesors*') ? 'active' : '' }}">
    <a href="{{ route('asesors.index') }}"><i class="fa fa-edit"></i><span>Asesors</span></a>
</li>

<li class="{{ Request::is('cursos*') ? 'active' : '' }}">
    <a href="{{ route('cursos.index') }}"><i class="fa fa-edit"></i><span>Cursos</span></a>
</li>

<li class="{{ Request::is('anuncios*') ? 'active' : '' }}">
    <a href="{{ route('anuncios.index') }}"><i class="fa fa-edit"></i><span>Anuncios</span></a>
</li>

<li class="{{ Request::is('estudiantes*') ? 'active' : '' }}">
    <a href="{{ route('estudiantes.index') }}"><i class="fa fa-edit"></i><span>Estudiantes</span></a>
</li>

<li class="{{ Request::is('matriculados*') ? 'active' : '' }}">
    <a href="{{ route('matriculados.index') }}"><i class="fa fa-edit"></i><span>Matriculados</span></a>
</li>

<li class="{{ Request::is('activities*') ? 'active' : '' }}">
    <a href="{{ route('activities.index') }}"><i class="fa fa-edit"></i><span>Activities</span></a>
</li>

<li class="{{ Request::is('contenidos*') ? 'active' : '' }}">
    <a href="{{ route('contenidos.index') }}"><i class="fa fa-edit"></i><span>Contenidos</span></a>
</li>

<li class="{{ Request::is('tasks*') ? 'active' : '' }}">
    <a href="{{ route('tasks.index') }}"><i class="fa fa-edit"></i><span>Tasks</span></a>
</li>

