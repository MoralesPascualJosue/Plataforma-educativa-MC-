<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDEPI</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">

</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" action="{{ url('/login') }}">
                    @csrf
                    <span class="login100-form-title p-b-34">
                        Inicia sessión
                    </span>

                    <div
                        class="rs1-wrap-input100 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <p>Correo</p>
                        <div class="wrap-input100 validate-input m-b-20" data-validate="Escribe tu correo">
                            <input id="email" class="input100" type="email" name="email" value="{{ old('email') }}"
                                placeholder="...">
                            <span class="focus-input100"></span>
                        </div>

                        @if ($errors->has('email'))
                        <span class="help-block text-red fs-14">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div
                        class="rs2-wrap-input100 form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                        <p>Contraseña</p>
                        <div class="wrap-input100 validate-input m-b-20" data-validate="Escribe tu contraseña">
                            <input class="input100" type="password" name="password" placeholder="...">
                            <span class="focus-input100"></span>
                        </div>

                        @if ($errors->has('password'))
                        <span class="help-block text-red">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Ingresar
                        </button>
                    </div>

                    <div class="text-center p-t-5">
                        <div class="txt1">
                            <label>
                                <input type="checkbox" name="remember"> Recuerdame
                            </label>
                        </div>
                    </div>

                    <div class="w-full text-center p-t-27 p-b-40">
                        <span class="txt1">
                            Olvide
                        </span>

                        <a href="{{ url('/password/reset') }}" class="txt2">
                            Usuario / contraseña?
                        </a>

                    </div>

                    <div class="w-full text-center">
                        <a href="{{ url('/') }}" class="txt3 p-r-10">
                            Inicio
                        </a>

                        <a href="{{ url('/register') }}" class="txt3">
                            Registrarse
                        </a>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('resources/welcome2.jpg');"></div>
            </div>
        </div>
    </div>

</body>

</html>