@extends('layouts.app')

@section('migasdepan')
<h1>
        Tipos de contrato
        <small>Control de tipos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/tipocontratos') }}"><i class="fa fa-dashboard"></i> Tipos de contrato</a></li>
        <li class="active">Listado de tipos</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/tipocontratos/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/tipocontratos?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/tipocontratos?estado=2') }}" class="btn btn-primary">Papelera</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Tipo de contrato</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($tipocontratos as $tipocontrato)
                  <tr>
                    <td>{{ $tipocontrato->id }}</td>
                    <td>{{ $tipocontrato->nombre }}</td>
                    <td>{{ $tipocontrato->estado }}</td>
                    <td>
                            @if($estado == 1 || $estado == "")
                                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                                <a href="{{ url('tipocontratos/'.$tipocontrato->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="{{ url('/tipocontratos/'.$tipocontrato->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$tipocontrato->id.",'tipocontratos')" }}><span class="glyphicon glyphicon-trash"></span></button>
                                {{ Form::close()}}
                            @else
                                {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                                <button class="btn btn-success btn-xs" type="button" onclick={{ "alta(".$tipocontrato->id.",'tipocontratos')" }}><span class="glyphicon glyphicon-trash"></span></button>
                                {{ Form::close()}}
                             @endif
                        </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
                
              <div class="pull-right">

              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
@endsection
