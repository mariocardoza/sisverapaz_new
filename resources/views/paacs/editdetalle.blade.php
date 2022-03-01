@extends('layouts.app')

@section('migasdepan')
<h1>
Editar <small>{{$paac->obra}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{ url('/paacs') }}"><i class="fa fa-line-chart"></i> Plan anual</a></li>
        <li class="active">Edición</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Form::model($paac, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('paacdetalles.update', $paac->id))) }}
                <div class="form-group">
                  <label for="" class="col-md-2 control-label">Obra, Bien o Servicio</label>
                  <div class="col-md-8">
                      {{ Form::hidden('paac_id')}}
                      {{ Form::textarea('obra', null,['class' => 'form-control','rows' => 3,'id' => 'obra']) }}
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                    <label for="" class="col-md-4 control-label"><b>Montos establecidos por cada mes</b></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                    <label for="" class="col-md-2 control-label">Enero</label>
                          {{ Form::text('enero', null,['class' => 'form-control','id' => 'ene']) }}

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Febrero</label>
                          {{ Form::text('febrero', null,['class' => 'form-control','id' => 'feb']) }}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Marzo</label>
                          {{ Form::text('marzo', null,['class' => 'form-control ','id' => 'mar']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                    <label for="" class="col-md-2 control-label">Abril</label>
                          {{ Form::text('abril', null,['class' => 'form-control','id' => 'abr']) }}

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Mayo</label>
                          {{ Form::text('mayo', null,['class' => 'form-control','id' => 'may']) }}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Junio</label>
                          {{ Form::text('junio', null,['class' => 'form-control','id' => 'jun']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                    <label for="" class="col-md-2 control-label">Julio</label>
                          {{ Form::text('julio', null,['class' => 'form-control','id' => 'jul']) }}

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Agosto</label>
                          {{ Form::text('agosto', null,['class' => 'form-control','id' => 'ago']) }}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Septiembre</label>
                          {{ Form::text('septiembre', null,['class' => 'form-control','id' => 'sep']) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                    <label for="" class="col-md-2 control-label">Octubre</label>
                          {{ Form::text('octubre', null,['class' => 'form-control','id' => 'oct']) }}

                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Noviembre</label>
                          {{ Form::text('noviembre', null,['class' => 'form-control','id' => 'nov']) }}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="col-md-2 control-label">Diciembre</label>
                          {{ Form::text('diciembre', null,['class' => 'form-control','id' => 'dic']) }}
                    </div>
                </div>


                <br>


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
