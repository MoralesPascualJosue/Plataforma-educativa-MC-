<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PDEPI</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <script src="{{asset('js/passwordreset.js')}}"> </script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form" method="post" action="{{ url('/password/reset') }}">
                    @csrf
                    <span class="login100-form-title p-b-34">
                        Restablecer tu contraseña
                    </span>

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="wrap-input100 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <p>Correo</p>
                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="Correo">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <p>Contraseña</p>
                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Nueva contraseña">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <p>confirmación</p>
                        <div
                            class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Contraseña confirmacion">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="login100-form-btn btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-refresh"></i>Restablecer contraseña
                                </button>
                            </div>
                        </div>

                        <div class="w-full text-center p-t-250">
                            <a href="{{ url('/') }}" class="txt3 p-r-10">
                                Inicio
                            </a>
                        </div>
                    </div>

                </form>

                <div class="login100-more" style="background-image: url('../../resources/welcome3.jpg');">
                </div>
            </div>

        </div>
    </div>

</body>

</html>