@extends('layouts.app')

@section('migasdepan')
    <h1>
        Solicitudes de cotizacion
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/solicitudcotizaciones') }}"><i class="fa fa-align-right"></i> Solicitudes</a></li>
        <li class="active">Edición</li>      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-11">
        <div class="panel panel-primary">
          <div class="panel-heading">Edicion de solicitud</div>
            <div class="panel-body">
                {{ Form::model($solicitud, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('solicitudcotizaciones.update', $solicitud->id))) }}
                @include('solicitudcotizaciones.formulario')
                @include('errors.validacion')
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span>    Editar
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
      </div>    
    </div>
</div>
@endsection
@section('scripts')

@endsection
