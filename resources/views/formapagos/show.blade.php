@extends('layouts.app')

@section('migasdepan')
<h1>
        
        <small>Ver formas de pago <b>{{ $formapago->nombre }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/formapagos') }}"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Información de formas de pago </div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre de forma de pago: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$formapago->nombre}}</label><br>
                            
                        </div>

                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                            <label for="estado" class="col-md-4 control-label">Estado: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$formapago->estado}}</label><br>
                           
                        </div>

                      {{ Form::open(['route' => ['formapagos.destroy', $formapago->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                      <a href="{{ url('/formapagos/'.$formapago->id.'/edit') }}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"></span> Editar</a> |
                        <button class="btn btn-danger" type="button" onclick="
                        return swal({
                          title: 'Eliminar registro',
                          text: '¿Está seguro de eliminar registro?',
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