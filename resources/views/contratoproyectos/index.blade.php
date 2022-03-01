@extends('layouts.app')

@section('migasdepan')
<h1>
        Contratos
        <small>Control de contratos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratoproyectos') }}"><i class="fa fa-dashboard"></i> Contratos</a></li>
        <li class="active">Listado de contratos</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
              <div class="btn-group pull-right">
                <a href="{{ url('/contratoproyectos/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/contratoproyectos?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/contratoproyectos?estado=2') }}" class="btn btn-primary">Papelera</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>N°</th>
                  <th>Proyecto</th>
                  <th>Inicio del contrato</th>
                  <th>Fin del contrato</th>
                  <th>Hora de entrada</th>
                  <th>Hora de salida</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($contratoproyectos as $key => $contratoproyecto)
                  <tr>
                    <td>{{ $key+1}}</td>
                    <td>{{ $contratoproyecto->proyecto->nombre }}</td>
                    <td>{{fechaCastellano($contratoproyecto->inicio_contrato)}}</td>
                    <td>{{fechaCastellano($contratoproyecto->fin_contrato)}}</td>
                    <td>{{ $contratoproyecto->hora_entrada}}</td>
                    <td>{{ $contratoproyecto->hora_salida}}</td>
                    <td>
                      @if($estado == 1 || $estado == "")
                        {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                          <div class="btn-group">
                            <a href="{{ url('contratoproyectos/'.$contratoproyecto->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="{{ url('contratoproyectos/'.$contratoproyecto->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                            <a href="{{url('contratacionproyectos/create/'.$contratoproyecto->id)}}" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></a>
                            <a href="{{ url('contratacionproyectos?id='.$contratoproyecto->id) }}"> <i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$contratoproyecto->id.",'contratoproyectos')" }}><span class="glyphicon glyphicon-trash"></span></button>
                          </div>
                        {{ Form::close()}}
                      @else
                        {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                          <button class="btn btn-success btn-xs" type="button" onclick={{ "alta(".$contratoproyecto->id.",'contratoproyectos')" }}><span class="glyphicon glyphicon-trash"></span></button>
                        {{ Form::close()}}
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
@endsection
