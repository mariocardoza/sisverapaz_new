@extends('layouts.app')

@section('migasdepan')
    <h1>
        Agregar Tipo de servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/unidades') }}"><i class="fa fa-dashboard"></i> Unidad administrativa</a></li>
        <li class="active">Registro</li>      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de unidad administrativa</div>
                <div class="panel-body">
                    {{ Form::open(['action'=> 'UnidadAdminController@store', 'class' => 'form-horizontal']) }}
                    @include('errors.validacion')
                    @include('unidades.formulario')

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk">Registrar</span>
                            </button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection