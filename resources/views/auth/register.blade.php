<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    <title>Crear cuenta</title>
</head>

<body>
    <div class="limiter">
        <!-- multistep form -->
        <div class="container">
            <div class="wrap">
                <div class="form">
                    <form id="msform" method="post" action="{{ url('/register') }}">
                        @csrf
                        <a type="" href="{{ url('/login') }}" class="txtr">Ya me encuentro registrado</a>
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active">Datos de la cuenta</li>
                            <li>Tipo de cuenta</li>
                            <li>Datos personales</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <h2 class="fs-title">Crea tu cuenta</h2>
                            <h3 class="fs-subtitle">Este es el paso 1</h3>

                            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <a class="tittle-input">Correo</a>
                                <input type="email" name="email" placeholder="Correo" value="{{ old('email') }}" />
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <a class="tittle-input">Contraseña <span>(min. 8 caracteres)</span></a>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                    id="cn" />
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div
                                class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <a class="tittle-input">Confirmar Contraseña</a>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Confirmar contraseña" />
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <input type="button" name="next" class="next action-button" value="Continuar" />
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">Tipo de cuenta</h2>
                            <h3 class="helps">
                                <p>Maestro? elige asesor</p>
                                <p> Alumno? elige estudiante</p>
                            </h3>

                            <section class="sectionr cf">
                                <input type="radio" name="radio3" id="asesor" value="Asesor"><label class="four col"
                                    for="asesor">Asesor</label>
                                <input type="radio" name="radio3" id="estudiante" value="Estudiante" checked><label
                                    class="four col" for="estudiante">Estudiante</label>
                            </section>

                            <input type="button" name="previous" class="previous action-button" value="Regresar" />
                            <input type="button" name="next" class="next action-button" value="Continuar" />
                        </fieldset>
                        <fieldset>
                            <h2 class="fs-title">Datos personales</h2>
                            <h3 class="fs-subtitle">Eres tu ??</h3>

                            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <a class="tittle-input">Nombre</a>
                                <input type="text" class="form-control" name="name" placeholder="Nombre"
                                    value="{{ old('name') }}" />
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Institute Field -->
                            <div class="form-group has-feedback{{ $errors->has('instituto') ? ' has-error' : '' }}">
                                <a class="tittle-input">Instituto</a>
                                {!! Form::text('instituto', null, ['class' => 'form-control',"placeholder" =>
                                "Instituto"]) !!}
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('instituto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instituto') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- Department Field -->
                            <div class="form-group has-feedback{{ $errors->has('departamento') ? ' has-error' : '' }}">
                                <a class="tittle-input">Departamento</a>
                                {!! Form::text('departamento', null, ['class' => 'form-control', "placeholder" =>
                                "Departamento"]) !!}
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                @if ($errors->has('departamento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('departamento') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="checkbox">
                                <input class="checkboxmark" type="checkbox"> Acepto
                                <a href="#">términos y condiciones</a>
                            </div>
                            <input type="button" name="previous" class="previous action-button" value="Regresar" />
                            <button type="submit" class="button action-button">Registrarme</button>
                        </fieldset>
                    </form>
                </div>
                <div class="more" style="background-image: url('resources/welcome1.jpg');"></div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery/jquery-3.2.1.min.js')}}"> </script>
    <script src="{{asset('js/jquery/jqueryeasing.min.js')}}"> </script>
    <script src="{{asset('js/register.js')}}"> </script>

</body>

</html>