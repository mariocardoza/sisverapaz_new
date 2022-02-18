@extends('layouts.app')

@section('migasdepan')
    <h1>
        Presupuesto de unidad
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/unidades') }}"><i class="fa fa-dashboard"></i> Presupuestos</a></li>
        <li class="active">Registro</li>      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de presupuestos</div>
                <div class="panel-body">
                    {{ Form::open(['action'=> 'PresupuestoUnidadController@store', 'class' => 'form-horizontal']) }}
                    @include('errors.validacion')
                    @include('unidades.presupuestos.formulario')
                    @include('unidades.presupuestos.tabla')

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="button" id="btnsub" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"> Registrar</span>
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
{{Html::script('js/presupuestounidad.js')}}
@endsection