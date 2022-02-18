@extends('layouts.app')

@section('migasdepan')
<h1>
   Perfil del Proveedor
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{ url('/proveedores') }}"><i class="fa fa-user-circle-o"></i> Proveedores</a></li>
        <li class="active">Perfil</li>
      </ol>
@endsection

@section('content')
<div class="">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ url('img/proveedor.png')}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{$proveedor->nombre}}</h3>
          @if($proveedor->giro_id!='')
          <p class="text-muted text-center">{{$proveedor->giro->nombre}}</p>
          @endif
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>{{$proveedor->direccion}}</b>
            </li>
            <li class="list-group-item">
              <b>Teléfono: </b>{{$proveedor->telefono}}
            </li>
            <li class="list-group-item">
              <b>{{$proveedor->email}}</b> 
            </li>
            <li class="list-group-item">
              <b>NIT: </b>{{$proveedor->nit}} 
            </li>
            <li class="list-group-item">
              <b>NRC: </b>{{$proveedor->numero_registro}} 
            </li>
            <li class="list-group-item">
              <b>DUI: </b>{{$proveedor->dui}} 
            </li>
          </ul>

          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <a href="javascript:void(0)" id="editar" title="Editar datos del proveedor" class="btn btn-warning"><span class="fa fa-edit"></span></a>
            </div>
            
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom" style=" ">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Actividad</a></li>
          <li><a href="#timeline" data-toggle="tab">Representante Legal</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity" style="max-height: 580px; overflow-y: scroll; overflow-y: auto;">
            @forelse ($proveedor->cotizacion as $c)
            <div class="post">
              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{url('img/cotizacion.png')}}" alt="user image">
                    <span class="username">
                      <a target="_blank" href="{{url('reportesuaci/solicitud/'.$c->solicitudcotizacion->id)}}">Solicitud número: {{$c->solicitudcotizacion->numero_solicitud}}</a>
                      <a href="#" class="pull-right btn-box-tool"><i class="fa fa-time"></i></a>
                    </span>
                <span class="description">Publicada el: - {{$c->solicitudcotizacion->created_at->format('d/m/Y H:i')}}</span>
              </div>
              <!-- /.user-block -->
              <p>
                La presente cotización corresponde 
                @if($c->solicitudcotizacion->tipo==2)
                a la actividad: <b>{{$c->solicitudcotizacion->requisicion->actividad}}</b>
                @elseif($c->solicitudcotizacion->tipo==3)
                a las requisicones: <b>@foreach($c->solicitudcotizacion->solirequi->requisiciones as $r){{$r->actividad}}, @endforeach</b>
                @endif
                haciendo un total de <b>${{\App\Cotizacion::total_cotizacion($c->id)}}</b>;
                con una forma de pago de: <b>{{$c->formapago->nombre}}</b>
              </p>
              <ul class="list-inline">
                <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Ver cotización</a></li>
                @if($c->seleccionado==1)
                <li style="color:green;"><a href="javascript:void(0)" class="link-black text-sm"><i style="color: green;" class="fa fa-thumbs-o-up margin-r-5"></i> Cotización aprobada</a>
                </li>
                @else
                <li><a style="color:red;" href="javascript:void(0)" class="link-black text-sm"><i style="color: red;" class="fa fa-thumbs-o-down margin-r-5"></i> Cotización rechazada</a>
                </li>
                @endif
               
              </ul>
            </div>
            @empty
            <center>
              <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> No Existen Registros</h4>
              <span>No se ha registrado ninguna cotización para éste proveedor</span><br>
            </center>
            @endforelse
            <!-- Post -->
            
            <!-- /.post -->
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            
            <div class="panel-body">
              <?php if($proveedor->nombrer != ''): ?>
                <table class="table">
                  <tr>
                    <td>Nombre</td>
                    <th>{{$proveedor->nombrer}}</th>
                  </tr>
                  <tr>
                    <td>Celular</td>
                    <th>{{$proveedor->celular_r}}</th>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <th>{{$proveedor->emailr}}</th>
                  </tr>
                   <tr>
                    <td>Teléfono fijo</td>
                    <th>{{$proveedor->telfijor}}</th>
                  </tr>
                  <tr>
                    <td>DUI</td>
                    <th>{{$proveedor->duir}}</th>
                  </tr>
                </table>
              <?php else: ?>
                <center>
                  <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                  <span>Registrar Datos del Representante Legal</span><br>
                  
                </center><br>
              <?php endif; ?>
              <center><button class="btn btn-warning" title="Editar datos del representante" id="show_representante"><span class="fa fa-edit"></span></button></center>
            </div>
          </div>
          <!-- /.tab-pane -->

          
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
</div>
@include('proveedores.modales')
@endsection
@section('scripts')
<script type="text/javascript">
  elproveedor='<?php echo $proveedor->id ?>';
</script>
{!! Html::script('js/proveedor.js?cod='.date('Yidisus')) !!}
@endsection
