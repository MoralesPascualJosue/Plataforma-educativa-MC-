<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDEPI</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <form class="login100-form" method="post" action="{{ url('/password/email') }}">
                    @csrf
                    <span class="login100-form-title p-b-34">
                        Ingresa tu correo para restablecer tu contraseña
                    </span>

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="wrap-input100 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <p>Correo</p>
                        <div class="wrap-input100 validate-input m-b-20">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Email">
                            <span class="focus-input100 glyphicon glyphicon-envelope form-control-feedback"></span>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="container-login100-form-btn col-md-12">
                            <button type="submit" class="login100-form-btn btn btn-primary pull-right">
                                <i class="fa fa-btn fa-envelope"></i> .>>. Enviar enlace de establecimiento de
                                contraseña
                            </button>
                        </div>

                        <div class="w-full text-center p-t-250">
                            <a href="{{ url('/') }}" class="txt3 p-r-10">
                                Inicio
                            </a>
                        </div>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('../resources/welcome3.jpg');">
                </div>
            </div>

        </div>
    </div>


    {{-- <script src="{{asset('js/jquery/jquery-3.2.1.min.js')}}"> </script> --}}
    <script src="{{asset('js/main.js')}}"> </script>

</body>

</html>