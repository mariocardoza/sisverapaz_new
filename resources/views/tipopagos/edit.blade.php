@extends('layouts.app')

@section('migasdepan')
<h1>
      Editar Tipo pago: <small> {{ $tipopago->nombre }} </small>
</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{ url('/tipopagos') }}"><i class="fa fa-industry"></i> Tipos</a></li>
        <li class="active">Edición</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Form::model($tipopago, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('tipopagos.update', $tipopago->id))) }}
                 @include('tipopagos.formulario')
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary btn-lg">
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
