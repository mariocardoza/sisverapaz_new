@extends('layouts.app')

@section('migasdepan')
<h1>
        Editar plan anual
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Editar plan</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Form::model($paac, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('paacs.update', $paac->id))) }}
                <div class="form-group">
                  <label for="" class="col-md-4 control-label">Descripcion plan anual</label>
                    <div class="col-md-6">
                          {{ Form::text('descripcion', null,['class' => 'form-control','id' => 'sep','required']) }}
                    </div>
                </div>
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
@endsection
