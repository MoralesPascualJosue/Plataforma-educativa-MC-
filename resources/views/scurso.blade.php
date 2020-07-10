@extends('layouts.front')


@section('content')

<script>
  $("div.alert")
        .not(".alert-important")
        .delay(3000)
        .fadeOut(350);
</script>

@include('flash::message')

<div class="container">

  <div class="item1">
    {!! Form::model($curso, ['route' => ['updatecover', $curso->id], 'method' => 'post', 'files' =>
    true,'id'=>'avatarForm','style'=>'display: none']) !!}

    <input type="file" id="avatarInput" name="cover">
    {!! Form::close() !!}

    @if ($curso->cover==null)
    <div class="curse-img-header"
      style="background: url('../resources/welcome1.jpg')  no-repeat; background-size: cover; background-position:0;">
      @can('edit cursos')
      <button id="avatarImage" class="float-ru bb-close">E</button>
      @endcan
    </div>
    @else
    <div class="curse-img-header" style="background: url({{ asset($curso->cover)}}) ; background-size: contain;">
      @can('edit cursos')
      <button id="avatarImage" class="float-ru bb-close btned">
        <img src="{{ asset("resources/icons/edit-a.svg") }}" alt="editar" width="14px">
      </button>
      @endcan
    </div>
    @endif

    <div class="curse-header">
      <div class="avatar-container">
        <div class="user-img-header">
          @if($curso->asesor->image == null)
          <img src="{{ asset('resources/users/user-default.svg') }}" width="142px" />
          @else
          <img src="{{ asset( $curso->asesor->image ) }}" width="142px" />
          @endif
        </div>
      </div>
      <div class="user-name-header">
        <span id="name-u">{!! $curso->asesor->name !!}</span>
      </div>
      <div class="username-header">
        <span>Asesor</span>
      </div>

    </div>

    <div class="curso-message">
      <p class="cursoreview">{!! $curso->review!!}</p>

      @can('edit cursos')

      <div class=" tools-course canedit">
        <ul class="course-tools">
          <li class="course-tool-tab tooltip editm" id="{{ $curso->id }}">
            <a class="course-tab-content" href="javascript:void(0);">
              <img src="{{ asset("resources/icons/edit-a.svg") }}" alt="editar">
            </a>
            <span class="tooltiptext">Editar</span>
          </li>

        </ul>
      </div>

      @endcan
    </div>

    <div class="aside">
      <div class="aside-header">Detalles y acciones</div>

      <div class="aside-link">
        <a href="{{route("actividadescurso", $curso->id )}}">
          <div class="aside-link-icon">
            <img src="{{ asset("resources/icons/list-c.svg") }}" alt="lista">
          </div>
          <div class="aside-link-details">
            <div class="aside-link-name">Lista</div>
            <div class="aside-link-content">Ver losparticipantes del curso</div>
          </div>
        </a>
      </div>

      <div class="aside-link">
        <a href="javascript:void(0);">
          <div class="aside-link-icon">
            <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
          </div>
          <div class="aside-link-details">
            <div class="aside-link-name">Grupos del curso</div>
            <div class="aside-link-content">2 grupos</div>
          </div>
        </a>
      </div>
      @can('edit cursos')
      <div class="aside-link delete" id="{{ $curso->id }}">
        <a href="javascript:void(0);">
          <div class="aside-link-icon">
            <img src="{{ asset("resources/icons/delete-a.svg") }}" alt="eliminarc">
          </div>
          <div class="aside-link-details">
            <div class="aside-link-name">Eliminar curso</div>
            <div class="aside-link-content">se eliminara todo el contenido</div>
          </div>
        </a>
      </div>
      @endcan
    </div>

  </div>

  <div class="curse-container item2">
    <div class="column-content">
      <div class="aside-header">
        <div class="der">Contenido</div>
        @can('edit cursos')
        <div class="newactivitie izq" id="{{ $curso->id }}">Nueva actividad</div>
        @endcan
      </div>

      <div class="course-actidades">

        @include('activities.showactivities')

      </div>

      {{ $actividades->links() }}

    </div>


  </div>

  <div class="menud">
    <div>Eliminar</div>
    <div class="menud-option menud-option-confirmar" id="">Si</div>
    <div class="menud-option menud-option-cancel">No</div>
  </div>

</div>
@endsection

@push('script')
@endpush