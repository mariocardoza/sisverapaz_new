@extends('layouts.app')

@section('migasdepan')
<h1>
Editar <small>{{$requisicion->requisicion->descripcion}}</small>
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
          <div class="panel-heading">Edición de la requisición</div>
            <div class="panel-body">
                {{ Form::model($requisicion, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('requisiciondetalles.update', $requisicion->id))) }}
                <div class="form-group">
                  <label for="" class="col-md-4 control-label">Descripcion</label>
                    <div class="col-md-6">
                      {!!Form::text('descripcion',null,['class' => 'form-control', 'id' => 'descripcion' ])!!}
                    </div>
                </div>

                <div class="form-group">
                  <label for="" class="col-md-4 control-label">Unidad de medida</label>
                  <div class="col-md-6">
                    <select name="unidad_medida" class="chosen-select-width">
                      <option value="">Seleccione una unidad administrativa</option>
                      @foreach($medidas as $medida)
                        <option value="{{$medida->id}}">{{$medida->nombre_medida}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="" class="col-md-4 control-label">Cantidad</label>
                  <div class="col-md-6">
                    {!!Form::hidden('requisicion_id')!!}
                    {!!Form::text('cantidad',null,['class' => 'form-control', 'id' => 'cantidad' ])!!}
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
</div>
@endsection
