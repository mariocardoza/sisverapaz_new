@extends('layouts.app')

@section('migasdepan')
<h1>
        
        <small>Ver detalle <b>{{ $detalle->nombre }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/detallecotizaciones') }}"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos de detalle </div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('cotizacion_id') ? ' has-error' : '' }}">
                            <label for="cotizacion_id" class="col-md-4 control-label">Cotización: </label>
                            <label for="cotizacion_id" class="col-md-4 control-label">{{$detallecotizacion->cotizacion_id}}</label><br>
                            
                        </div>

                         <div class="form-group{{ $errors->has('unidad_id') ? ' has-error' : '' }}">
                            <label for="unidad_id" class="col-md-4 control-label">Unidad de medida: </label>
                            <label for="cotizacion_id" class="col-md-4 control-label">{{$detallecotizacion->unidad_id}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                            <label for="cantidad" class="col-md-4 control-label">Cantidad: </label>
                            <label for="cotizacion_id" class="col-md-4 control-label">{{$detallecotizacion->cantidad}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('precio_unitario') ? ' has-error' : '' }}">
                            <label for="precio_unitario" class="col-md-4 control-label">Precio unitario: </label>
                            <label for="cotizacion_id" class="col-md-4 control-label">{{$detallecotizacion->precio_unitario}}</label><br>
                            
                        </div>


                      {{ Form::open(['route' => ['proyectos.destroy', $proyecto->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                      <a href="{{ url('/proyectos/'.$proyecto->id.'/edit') }}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"></span> Editar</a> |
                        <button class="btn btn-danger" type="button" onclick="
                        return swal({
                          title: 'Eliminar proyecto',
                          text: '¿Está seguro de eliminar proyecto?',
                          type: 'question',
                          showCancelButton: true,
                          confirmButtonText: 'Si, Eliminar',
                          cancelButtonText: 'No, Mantener',
                          confirmButtonClass: 'btn btn-danger',
                          cancelButtonClass: 'btn btn-default',
                          buttonsStyling: false
                        }).then(function(){
                          submit();
                          swal('Hecho', 'El registro a sido eliminado','success')
                        }, function(dismiss){
                          if(dismiss == 'cancel'){
                            swal('Cancelado', 'El registro se mantiene','info')
                          }
                        })";><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                      {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection