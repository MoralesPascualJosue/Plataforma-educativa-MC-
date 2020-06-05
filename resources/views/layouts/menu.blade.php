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
</li><li class="{{ Request::is('works*') ? 'active' : '' }}">
    <a href="{{ route('works.index') }}"><i class="fa fa-edit"></i><span>Works</span></a>
</li>

<li class="{{ Request::is('qualifications*') ? 'active' : '' }}">
    <a href="{{ route('qualifications.index') }}"><i class="fa fa-edit"></i><span>Qualifications</span></a>
</li>

<li class="{{ Request::is('fcategorias*') ? 'active' : '' }}">
    <a href="{{ route('fcategorias.index') }}"><i class="fa fa-edit"></i><span>Fcategorias</span></a>
</li>

<li class="{{ Request::is('fdiscusions*') ? 'active' : '' }}">
    <a href="{{ route('fdiscusions.index') }}"><i class="fa fa-edit"></i><span>Fdiscusions</span></a>
</li>

<li class="{{ Request::is('fposts*') ? 'active' : '' }}">
    <a href="{{ route('fposts.index') }}"><i class="fa fa-edit"></i><span>Fposts</span></a>
</li>

<li class="{{ Request::is('userFdiscusions*') ? 'active' : '' }}">
    <a href="{{ route('userFdiscusions.index') }}"><i class="fa fa-edit"></i><span>User Fdiscusions</span></a>
</li>

