@extends('layouts.app')

@section('migasdepan')
<h1>
        Contrato: {{ $contrato->nombre }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratos') }}"><i class="fa fa-dashboard"></i> Contratos</a></li>
        <li class="active">Edición</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                {{ Form::model($contrato, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('contratos.update', $contrato->id))) }}
                 @include('contratos.formulario')
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
@endsection
@section('scripts')
{!! Html::script('js/contrato.js') !!}
@endsection
