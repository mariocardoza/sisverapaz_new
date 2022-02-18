@extends('layouts.app')

@section('migasdepan')
<h1>
        
        <small>Ver cobro <b>{{ $tipocobro->nombre_cobro }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/tipocobros') }}"><i class="fa fa-dashboard"></i> Cobros</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos del cobro </div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('nombre_cobro') ? ' has-error' : '' }}">
                            <label for="nombre_cobro" class="col-md-4 control-label">Nombre del cobro: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$tipocobro->nombre_cobro}}</label><br>
                        </div>

                         <div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
                            <label for="monto" class="col-md-4 control-label">Monto: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$tipocobro->monto}}</label><br>
                        </div>

                      {{ Form::open(['route' => ['tipocobros.destroy', $tipocobro->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                      <a href="{{ url('/rubros/'.$tipocobro->id.'/edit') }}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"></span> Editar</a> |
                        <button class="btn btn-danger" type="button" onclick="
                        return swal({
                          title: 'Eliminar tipo cobro',
                          text: '¿Está seguro de eliminar el registro?',
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