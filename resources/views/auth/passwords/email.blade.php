@php
    $configuracion = \App\Configuracion::first();
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bienvenido a SISVERAPAZ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<style>
    h1{   
        color: #6a59df;
        font-weight: 600;
    }
</style>
</head>
<body class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="text-center">Alcaldía Municipal de San José Verapaz</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="login-box">
                    <div class="login-logo">
                      <!--a href="#"><b>SIS</b>VERAPAZ</a-->
                      <h1>SISVERAPAZ</h1>
                    </div>
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                      <p class="login-box-msg-large"><h4 class="text-center">Digite su correo para recueperar su contraseña</h4></p>
                      @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
          
                  <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                      {{ csrf_field() }}
          
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="control-label">Dirección E-Mail</label>
          
                          <div class="col-md-12">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          
                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-md-6">
                              <button type="submit" class="btn btn-primary">
                                  Enviar enlace de restauración
                              </button>
                          </div>
                      </div>
                  </form>
                    </div>
                    <!-- /.login-box-body -->
                  </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div style="margin-top: 7em;"></div>
                <center><img width="50%" height="100%" src="{{ $configuracion->escudo_alcaldia !='' ? $configuracion->url_path :asset("img/escudoamverapaz.png") }}" class="" alt="escudo El Salvador"></center>
            </div>
        </div>
    </div>

<!-- /.login-box -->


<script>
    $('div.alert').not('.alert-important').delay(9000).fadeOut(350);
</script>
<footer class="main-footer" style="margin-left:0;position: fixed;bottom:0;width:100%;">
    <strong> &copy; {{date("Y")}} <a class="text-center" target="_blank" href="http://www.ues.edu.sv">Universidad de El Salvador. FMP</a>.</strong> Todos los derechos reservados
</footer>
</body>
</html>

