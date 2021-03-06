@extends('layouts.app')

@section('migasdepan')
<h1>
    Servicios Municipales
    <small>Control de servicios</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i>Inicio</a></li>
    <li><a href="{{ url('/tiposervicios') }}"><i class="fa fa-address-card"></i>Servicios</a></li>
    <li class="active">Registro</li>
</ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de servicios</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'TiposervicioController@store', 'class' => 'form-horizontal','autocomplete'=>'off']) }}
                    @include('errors.validacion')
                    @include('tiposervicios.formulario')

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {{Form::button('<span class="glyphicon glyphicon-floppy-disk"></span>Registrar',[
                            'type' => 'submit',
                            'class' => 'btn btn-success',
                            ])}}

                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection