@extends('layouts.app')

@section('migasdepan')
    <h1>
        Requisiciones
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        @if(Auth()->user()->hasRole('uaci'))
        <li><a href="{{ url('/requisiciones') }}"><i class="fa fa-balance-scale"></i> Requisiciones</a></li>
        @else
        <li><a href="{{ url('/requisiciones/porusuario') }}"><i class="fa fa-balance-scale"></i> Mis requisiciones</a></li>
        @endif
      <li class="active">Registro</li>
      </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de una nueva requisición</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'RequisicionController@store','class' => 'form-horizontal','id' => 'form_requisicion']) }}
                    @include('requisiciones.formulario')
                    {{Form::hidden('conpresupuesto',1)}}
                    <br>
                    <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      Agregar requisiciones
                    </button-->
                    <br>
                    
                    
                    <center><div class="form-group">
                        <div class="">
                            <a href="{{route('requisiciones.porusuario')}}" class="btn btn-danger">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                <span class=""></span>    Guardar
                            </button>
                        </div>
                    </div>
                    </center>
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
