@extends('layouts.app')

@section('migasdepan')
<h1>
        Contratos
        <small>Control de contratos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratos') }}"><i class="fa fa-dashboard"></i> Contratos</a></li>
        <li class="active">Listado de contratos</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/contratos/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/contratos?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/contratos?estado=2') }}" class="btn btn-primary">Papelera</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Contratado</th>
                  <th>Tipo de contrato</th>
                  <th>Cargo</th>
                  <th>Salario</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($contratos as $contrato)
                  <tr>
                    <td>{{ $contrato->id }}</td>
                    <td>{{ $contrato->empleado->nombre }}</td>
                    <td>{{ $contrato->tipocontrato->nombre }}</td>
                    <td>{{ $contrato->cargo->cargo }}</td>
                    <td>{{ $contrato->salario }}</td>
                    <td>
                            @if($estado == 1 || $estado == "")
                                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                                <a href="{{ url('contratos/'.$contrato->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="{{ url('/contratos/'.$contrato->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$contrato->id.",'contratos')" }}><span class="glyphicon glyphicon-trash"></span></button>
                                {{ Form::close()}}
                            @else
                                {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                                <button class="btn btn-success btn-xs" type="button" onclick={{ "alta(".$contrato->id.",'contratos')" }}><span class="glyphicon glyphicon-trash"></span></button>
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