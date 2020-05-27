@extends('layouts.app')


@section('title', 'Perfil')
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
@endsection

@section('content')

<script>
    $("div.alert")
    .not(".alert-important")
    .delay(3000)
    .fadeOut(350);
</script>

<div class="background"></div>

<div class="container-top">

    {!! Form::model($perfil, ['route' => ['updateimage'], 'method' => 'post', 'files' =>
    true,'id'=>'avatarForm','style'=>'display: none']) !!}

    <input type="file" id="avatarInput" name="image">
    {!! Form::close() !!}

    <div class="avatar-container">
        <div class="avatar" id="avatarImage">
            @if ($perfil->image==null)
            <img src="{{ asset('resources/users/user-default.svg') }}" width="142px" />
            @else
            <img src="{{ asset( $perfil->image) }}" width="142px" />
            @endif
        </div>
    </div>

    <div class="user-name-container">
        <span id="name-u">{{ Auth::user()->name }}</span>
    </div>
    <div class="username-container">
        <span>{{ Auth::user()->email }}</span>
    </div>
    @include('flash::message')
</div>

<div class="columns">
    <div class="column user-information">
        <section>
            <h2>Información básica</h2>
            <ul>
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Nombre completo</span>
                        <a class="data-value">
                            <div class="editable" id="editable-nombre">{{ $perfil->name }}</div>
                        </a>
                    </div>
                </li>

                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Dirección de correo electrónico</span>
                        <a class="data-value">
                            <div class="editable" id="editable-correo">{{ Auth::user()->email }}</div>
                        </a>
                    </div>
                </li>

                <li class="data-row">
                    <div class=" data-container">
                        <span class="data-title">Contraseña</span>
                        <a class="data-value">
                            <span>Cambiar contraseña</span>
                        </a>
                    </div>
                </li>

            </ul>
        </section>

        <section>
            <h2>Información de contacto</h2>
            <ul>
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Número de teléfono</span>
                        @if ($perfil->telephone==null)
                        <a class="data-value">
                            <div class="editable" id="editable-numero">Agregar número de teléfono</div>
                        </a>
                        @else
                        <a class="data-value">
                            <div class="editable" id="editable-numero">{{ $perfil->telephone }}</div>
                        </a>
                        @endif
                    </div>
                </li>
            </ul>
        </section>

        <section>
            <h2>Información laboral</h2>
            <ul>
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Institucion</span>
                        @if ($perfil->institute==null)
                        <a class="data-value">
                            <span>Test</span>
                        </a>
                        @else
                        <a class="data-value">
                            <div class="editable" id="editable-nombreinstituto">{{ $perfil->institute }}</div>
                        </a>
                        @endif
                    </div>
                </li>

                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Departamento</span>
                        @if ($perfil->department==null)
                        <a class="data-value">
                            <span>Distance Learning</span>
                        </a>
                        @else
                        <a class="data-value">
                            <div class="editable" id="editable-departamento">{{ $perfil->department }}</div>
                        </a>
                        @endif
                    </div>
                </li>
            </ul>
        </section>
    </div>

    <div class="column user-settings">
        <section>
            <h2>Configuración del sistema</h2>
            <ul>
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Ajustes de notificaciones globales</span>
                        <a class="data-value">
                            <span>Flujo de notificaciones</span>
                        </a>
                    </div>
                </li>

                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title"></span>
                        <a class="data-value">
                            <span>Notificaciones por correo electrónico</span>
                        </a>
                    </div>
                </li>

                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title"></span>
                        <a class="data-value">
                            <span>Notificaciones emergentes</span>
                        </a>
                    </div>
                </li>
            </ul>

        </section>

        <section>
            <br>
            <ul class="editar-perfil">
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Editar mi perfil</span>
                        <a class="data-value">
                            <span>editar</span>
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="guardar-perfil" id="{{ $perfil->id }}" style="visibility: hidden">
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Guardar mi perfil</span>
                        <a class="data-value">
                            <span>Guardar cambios</span>
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="cancelar-perfil" id="{{ $perfil->id }}" style="visibility: hidden">
                <li class="data-row">
                    <div class="data-container">
                        <span class="data-title">Cancelar</span>
                        <a class="data-value">
                            <span>Cancelar cambios</span>
                        </a>
                    </div>
                </li>
            </ul>
        </section>
    </div>


</div>

@endsection

@push('scripts')
@endpush