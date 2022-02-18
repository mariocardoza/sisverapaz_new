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
                      <p class="login-box-msg-large"><h4 class="text-center">Digite sus datos para iniciar sesión</h4></p>
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if(Session::has('mensaje'))
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('mensaje') }}
                            </div>
                        @endif
                      <form class="form-horizontal" role="form" method="POST" action="{{ route('authenticate') }}">
                          {{ csrf_field() }}
                  
                          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                              <label for="username" class="col-md-4 control-label">Nombre de Usuario (*)</label>
                  
                              <div class="col-md-8">
                                  <div class="input-group">
                                      <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus/>
                                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                      @if ($errors->has('username'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('username') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                          </div>
                  
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Contraseña (*)</label>
                  
                          <div class="col-md-8">
                              <div class="input-group">
                                  <input id="password" type="password" class="form-control" name="password" required>
                              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                              </div>
                          </div>
                  
                  
                        <div class="row">
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <div class="checkbox">
                                      <label>
                                          <label>(*) Campos Obligatorios</label>
                                      </label>
                                  </div>
                              </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
                          </div>
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                                                      ¿Olvidó su contraseña?
                          </a>
                          <!-- /.col -->
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
