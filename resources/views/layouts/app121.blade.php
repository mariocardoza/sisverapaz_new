@php
    $emergencia=[];
    $emergencia=App\Emergencia::where('estado',1)->count();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisVerapaz</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

@php
  $cod=date("Yisisus");
@endphp
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" type="text/css" media="print" href="{{ asset('css/fullcalendar.print.css')}}">
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhvC3rIiMvEM4JUPAl4fG1xNPRKoRnoTg"></script>
  <script src="{{ asset('js/funcionesgenerales.js') }}"></script>
<style>
  .buttons-html5{
    background: #337ab7;
    color: #ffffff;
    border-radius: 4px;
    padding: 8px 9px;
    border: 1px solid #FFFFFF;
  }
  .buttons-html5:hover{
    color: #337ab7;
    background: #ffffff;
    border-radius: 4px;
    padding: 8px 9px;
    border: 1px solid #337ab7;
  }
  .error{
    color:red;
  }
  .action-btn-wrapper {
    position: relative;
}
.icono-help{
  top: 5px;
  left: 8px;
  position: absolute;
}

.fixed-action-btn.my-custom-btn {
    position: absolute;
    right: 2px;
    top: 25px;
    padding-top: 15px;
    margin-bottom: 0;
    z-index: 2;
}
a.btn-floating.btn-large.red {
    margin-bottom: 0.5em; 
    width: 30px;
    height: 30px;
    border-radius: 100%;
    background: #F44336;
    right: 0;
    bottom: 0;
    position: absolute;
    border: none;
    outline: none;
    color: #FFF;
    font-size: 20px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    transition: .3s;
    opacity: 0.5;
    cursor: pointer;
}
a.btn-floating.btn-large.red:hover {
    width: 30px;
    height: 30px;
    border-radius: 100%;
    background: #F44336;
    right: 0;
    bottom: 0;
    position: absolute;
    border: none;
    outline: none;
    color: #FFF;
    font-size: 20px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    transition: .3s;
    opacity: 1;
    cursor: pointer;
}

/*.btn-primary{
  color: #fff;
  background-color: #0d6efd;
  border-color: #0d6efd;
}
.btn-primary:hover {
  color: #fff;
  background-color: #0756cc;
  border-color: #0d6efd;
}
.btn-primary:active {
  color: #fff;
  background-color: #0756cc;
  border-color: #0d6efd;
}
.btn-success {
    color: #fff;
    background-color: #198754;
    border-color: #198754;
}
.btn-danger > .btn-danger:hover{
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn-info {
    color: #000;
    background-color: #0dcaf0;
    border-color: #0dcaf0;
}
.btn-warning {
    color: #000;
    background-color: #ffc107;
    border-color: #ffc107;
}
.panel-primary > .panel-heading {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}*/
</style>
</head>
<body class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>VZ</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SisVerapaz</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          @if(Auth()->guest())
            @include('layouts.notificaciones.notificacionesUsuario')
          @else
          @include('layouts.notificaciones.notificacionesUsuario')
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ Auth::user()->empleado->img_path }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth()->user()->empleado->nombre}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ Auth::user()->empleado->img_path }}" class="user-image" alt="User Image">

                <p>
                  {{Auth()->user()->roleuser->role->description}}
                  <small>Miembro {{Auth::user()->created_at->diffForHumans()}} </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">

                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('empleados/perfil/'.Auth::user()->empleado->id) }}" class="btn btn-default btn-flat"><i class="fa fa-user-circle"></i> Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-off"></i>
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
        @endif
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  @if(Auth()->guest())
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('avatars/avatar.jpg') }}" class="user-image" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Visitante </p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>
    </section>
  </aside>
  @else
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ Auth::user()->empleado->img_path }}" class="user-image" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth()->user()->empleado->nombre }} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>
     <!-- sidebar menu: : style can be found in sidebar.less -->
      @include('menu.menu')
    </section>
    <!-- /.sidebar -->
  </aside>
@endif
 <!-- aqui comienza el contenido -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    @yield('migasdepan')
    </section>

    <!-- Main content -->
    <section class="content" style="min-height: 545px;">
      <!-- Small boxes (Stat box) -->
    @if(Session::has('mensaje'))
        <?php
          echo ("<script type='text/javascript'>toastr.success('". Session::get('mensaje') ."');</script>");
         ?>
    @endif
    @if(Session::has('info'))
        <?php
          echo ("<script type='text/javascript'>toastr.info('". Session::get('info') ."');</script>");
         ?>
    @endif
    @if(Session::has('error'))
      <?php
        echo ("<script type='text/javascript'>toastr.error('". Session::get('error') ."');</script>");
       ?>
    @endif
    <div class="action-btn-wrapper" style="z-index: 2;">
      <div class="fixed-action-btn my-custom-btn horizontal">
        <a title="Ayuda" id="btn_help" class="btn-floating btn-large red">
            <i class="fa fa-question icono-help"></i>
        </a>
    </div>
    </div>
      @yield('content')

      <!-- /.row (main row) -->

      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_autizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Formulario de autorización por el administrador</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(['class' => '','id' => 'form_autorizacion']) }}
              
              <div class="form-group">
                <label for="" class="control-label">Digite el nombre de usuario</label>
                  <div class="">
                    <input type="text" id="el_username" name="username" class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label for="" class="control-label">
                      Contraseña
                  </label>
                  <div>
                        <input type="password" id="el_password" name="password" class="form-control">
                  </div>
              </div>
              {{Form::close()}}
            </div>
            <div class="modal-footer">
              <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="button" id="autorizacion_requi" class="btn btn-success">Confirmar</button></center>
            </div>
          </div>
          </div>
      </div>


        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_requi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrar requisición</h4>
              </div>
              <div class="modal-body">
                {{ Form::open(['class' => 'form-horizontal','id' => 'form_requi']) }}
                
                @php
    $unids=App\Unidad::where('estado',1)->get();
@endphp
<div class="form-group">
  <label for="" class="col-md-4 control-label">Actividad</label>
  <div class="col-md-6">
    {!! Form::textarea('actividad',null,['id'=>'actividad','class' => 'form-control','placeholder'=>'Digite la actividad a realizar','rows'=>3]) !!}
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4 control-label">Unidad Solicitante</label>
  <div class="col-md-6">
    <select name="unidad_id" id="unidad_id" class="chosen-select-width">
      @if(isset(Auth()->user()->id))
      @foreach ($unids as $uni)
          @if($uni->id==Auth()->user()->unidad_id)
            <option selected value="{{$uni->id}}">{{$uni->nombre_unidad}}</option>
          @endif
      @endforeach
      @endif
    </select>
  </div>
</div>

  <div class="form-group">
    <label for="" class="col-md-4 control-label">Responsable</label>
      <div class="col-md-6">
        @if(isset(Auth()->user()->id))
        {{Form::hidden('user_id',Auth()->user()->id,['id'=>'user_id'])}}
        {!!Form::text('',Auth()->user()->empleado->nombre,['class' => 'form-control','readonly'])!!}
        @endif
      </div>
  </div>

  <div class="form-group">
    <label for="" class="col-md-4 control-label">Fecha actividad</label>
    <div class="col-md-6">
      {{Form::text('fecha_actividad',null,['class'=>'form-control fechita','autocomplete'=>'off','id'=>'fecha_actividad'])}}
  

    </div>
  </div>

  <div class="form-group">
    <label for="" class="col-md-4 control-label">Observaciones</label>
      <div class="col-md-6">
        {!!Form::textarea('observaciones',null,['id'=>'observaciones','class' => 'form-control','rows' => 3])!!}
      </div>
  </div>
                {{Form::hidden('conpresupuesto',0,['id'=>'conpre'])}}
                {{Form::close()}}
              </div>
              <div class="modal-footer">
                <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" id="guardar_req" class="btn btn-success">Guardar</button></center>
              </div>
            </div>
            </div>
          </div>


          <div class="modal fade" id="modal_pdf" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h5 class="text-center">Vista previa de impresión</h5>
                </div>
                <div class="modal-body">
                  <center>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button onclick="printDoc()" type="button" class="btn btn-success" data-dismiss="modal">Imprimir</button>
                  </center>
                  <br>
                  <iframe id="verpdf" src="" width="100%" height="1200px" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                  
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_comentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="">Agregar comentario</h4>
                </div>
                <div class="modal-body">
                  {{ Form::open(['class' => '','id' => 'form_comentario']) }}
                      
                    <div class="form-group">
                        <label for="" class="control-label">Motivo</label>
                        <div class="">
                            <textarea autocomplete="off" placeholder="Digite el comentario"  required id="comentario" name="comentario" class="form-control"></textarea>
          
                        <input type="hidden" name="tabla_id" id="tabla_id" value="" class="form-control">
                        <input type="hidden" name="tabla" id="tabla" value="" class="form-control">
                        <input type="hidden" name="destinatario_id" id="destinatario_id" value="" class="form-control">
          
                    </div>
                    </div>
                              
                  
                </div>
                <div class="modal-footer">
                  <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button></center>
                </div>
                {{Form::close()}}
              </div>
              </div>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer hidden-print">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong> &copy; {{date("Y")}} <a target="_blank" href="http://www.ues.edu.sv">Universidad de El Salvador. FMP</a>.</strong> Todos los derechos reservados
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



@yield('scripts')
<script>
   //eliminar la requisicion
   $(document).on("click","#agregar_comentario",function(e){
        $("#modal_comentario").modal("show");
        var tabla = $(this).attr('data-tabla');
        var tabla_id = $(this).attr('data-id');
        var destinatario_id = $(this).attr('data-destinatario');
        $("#comentario").val("");
        $("#tabla").val(tabla);
        $("#tabla_id").val(tabla_id);
        $("#destinatario_id").val(destinatario_id);
      });

      /// comentarios a la requisicion
      $(document).on("submit","#form_comentario",function(e){
        e.preventDefault();
        var form = $("#form_comentario").serialize();
        $.ajax({
          url:'/save-comment',
          dataType:'json',
          type:'POST',
          data:form,
          success: function(response){
            if(response[0]==1){
              toastr.success("Comentario enviado con éxito");
              $("#comentario").val("");
              $("#modal_comentario").modal("hide");
            }
          },
          error:function(error){

          }
        })
      });
      function printDoc() {
        document.getElementById('verpdf').focus(); 
        document.getElementById('verpdf').contentWindow.print();
      }
</script>
 
{{-- {!! Html::script('js/main.js') !!} --}}
</body>
</html>
