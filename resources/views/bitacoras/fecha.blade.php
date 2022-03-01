@extends('layouts.app')

@section('migasdepan')
<h1>
        Bitacora
        <small>Control de bitacora</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/bitacoras') }}"><i class="fa fa-dashboard"></i> Bitacoras</a></li>
        <li class="active">Listado de bitacoras</li>
      </ol>
@endsection

@section('content')
<div class="col-xs-12">
          <div class="box">
            <div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Datos del Proveedor</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Datos de Representante</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Finalizar</p>
        </div>
    </div>
    </div>

    <form role="form">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Datos del proveedor o Empresa</h3>
                <div class="form-group">
                    <label class="control-label">Nombre del proveedor</label>
                    {{ Form::text('nombree', null,['class' => 'form-control','required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Dirección</label>
                    {{ Form::text('direccion', null,['class' => 'form-control','required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    {{ Form::text('telefonoe', null,['class' => 'form-control','required']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    {{ Form::email('emaile', null,['class' => 'form-control','required']) }}
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Datos de representante (si lo hay)</h3>
                <div class="form-group">
                    <label class="control-label">Nombre</label>
                    {{ Form::text('nombrer', null,['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Telefono fijo</label>
                    {{ Form::text('telfijor', null,['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Celular</label>
                    {{ Form::text('telfijor', null,['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                     {{ Form::email('emailr', null,['class' => 'form-control']) }}
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Siguinte</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> ¿Los datos son correctos?</h3>
                <button class="btn btn-success btn-lg pull-right" type="submit">Guardar</button>
            </div>
        </div>
    </div>
</form>
        </div>
@endsection
