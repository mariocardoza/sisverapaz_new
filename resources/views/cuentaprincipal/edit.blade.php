@extends('layouts.app')

@section('migasdepan')
<h1>
        Cuenta N°: <small>{{ $cuenta->numero_de_cuenta }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ url('cuentaprincipal') }}"><i class="fa fa-dashboard"></i> Cuentas</a></li>
        <li class="active">Edición</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-11">
        <div class="panel panel-primary">
          <div class="panel-heading">Cuenta principal</div>
            <div class="panel-body">
                {{ Form::model($cuenta, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('cuentaprincipal.update', $cuenta->id))) }}
                 @include('cuentaprincipal.formulario')
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
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
