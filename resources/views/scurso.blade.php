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

      @can('edit cursos')
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
      @endcan

      @cannot('edit cursos')
      <div class="aside-link historiale" id="{{$curso->id}}">
        <a href="javascript:void(0);">
          <div class="aside-link-icon">
            <img src="{{ asset("resources/icons/group-c.svg") }}" alt="grupos">
          </div>
          <div class="aside-link-details">
            <div class="aside-link-name">Historial de entregas</div>
            <div class="aside-link-content">ver</div>
          </div>
        </a>
      </div>

      <div class="aside-header">Actividades hoy</div>

      @if (count($actividadeshoy))
      @foreach($actividadeshoy as $actividad)

      <div class="course-actividad">
        <a href="{{ route('sactivitiec', [$actividad->id]) }}">
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
      @else
      <div>No tienes actividades para hoy</div>
      @endif

      <div class="aside-header">Actividades de la semana</div>

      @if (count($actividadessemana))
      @foreach($actividadessemana as $actividad)

      <div class="course-actividad">
        <a href="{{ route('sactivitiec', [$actividad->id]) }}">
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
      @else
      <div>No tienes actividades para la semana</div>
      @endif
      @endcannot

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
    <div class="column-content v1">
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

    <div class="column-content v2">
      <div class="v2-regresar">Regresar</div>
      <div class="v2-content">

        <div class="finbyz-timeline">
          <div class="container  wgl-row-animation">
            <div class="row">
              <div class="vc_row wpb_row vc_row-fluid vc_custom_1542873226451 vc_row-has-fill wgl-row-animation"
                style=" box-sizing: border-box; width: 757px; position: relative;">
                <div
                  class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-offset-3 vc_col-lg-6 vc_col-md-offset-2 vc_col-md-8">
                  <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                      <div id="seofy_dbl_5cf90ca818809" class="seofy_module_double_headings acenter ">
                        <div class="heading_title" style="font-size:36px; line-height:1.333; font-weight:800; "><span
                            class="heading_divider"></span>
                          <div class="heading_title_mobile" style="font-size:32px; line-height: 1.333;">Historial de
                            entregas</div>
                        </div>
                      </div>
                      <div class="seofy_module_spacing">
                        <div class="spacing_size spacing_size-initial" style="height:5px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-12">
                  <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                      <div class="seofy_module_spacing">
                        <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                      </div>
                      <div id="item-content-h" class="seofy_module_time_line_vertical appear_anim">
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>
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