@extends('layouts.app')

@section('migasdepan')
<h1>

        <small>Ver contrato <b>{{ $contratosuministro->requisicion->nombre }}</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratosuministro') }}"><i class="fa fa-dashboard"></i> Listado</a></li>
        <li class="active">Ver</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos del contrato </div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('requisicion_id') ? ' has-error' : '' }}">
                            <label for="requisicion_id" class="col-md-4 control-label">Nombre del contrato: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$contratosuministro->requisicion->nombre}}</label><br>

                        </div>

                         <div class="form-group{{ $errors->has('proveedor_id') ? ' has-error' : '' }}">
                            <label for="proveedor_id" class="col-md-4 control-label">Nombre proveedor: </label>
                            <label for="nombre" class="col-md-4 control-label"> {{$contratosuministro->proveedor->nombre}}</label><br>

                        </div>

                        <div class="form-group{{ $errors->has('inicio_contrato') ? ' has-error' : '' }}">
                            <label for="inicio_contrato" class="col-md-4 control-label">Inicio de contrato: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$contratosuministro->inicio_contrato}}</label><br>

                        </div>

                        <div class="form-group{{ $errors->has('fecha_contratacion') ? ' has-error' : '' }}">
                            <label for="fecha_contratacion" class="col-md-4 control-label">Fecha de contratación: </label>
                            <label for="nombre" class="col-md-4 control-label">{{$contratosuministro->fecha_contratacion}}</label><br>

                        </div>


                      {{ Form::open(['route' => ['contratosuministros.destroy', $contratosuministro->id ], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
                      <a href="{{ url('contratosuministros/'.$contratosuministro->id.'/edit') }}" class="btn btn-warning"><span class="glyphicon glyphicon-text-size"></span> Editar</a> |
                        <button class="btn btn-danger" type="button" onclick="
                        return swal({
                          title: 'Eliminar contrato',
                          text: '¿Está seguro de eliminar contrato?',
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
