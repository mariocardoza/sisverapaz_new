@extends('layouts.app')

@section('migasdepan')
<h1>
Editar <small>{{$requisicion->descripcion}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{ url('/requisiciones') }}"><i class="fa fa-balance-scale"></i> Requisiciones</a></li>
        <li class="active">Edición</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
            <div class="panel-heading">Requisición</div>
                <div class="panel-body">
                    {{ Form::model($requisicion, array('method' => 'put','id'=>'form_requisicion_edit', 'class' => 'form-horizontal' , 'route' => array('requisiciones.update', $requisicion->id))) }}
                    @include('requisiciones.formulario')

                    <input type="hidden" id="elid" value="{{$requisicion->id}}">

                        <div class="form-group">
                            <div class="text-center">
                                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                     Guardar
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
{!! Html::script('js/requisicion.js?cod='.date('Yidisus')) !!}
@endsection