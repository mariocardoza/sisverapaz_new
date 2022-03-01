@extends('layouts.app')

@section('migasdepan')
<h1>
        Contratos
        <small>Control de contratos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratacionproyectos') }}"><i class="fa fa-dashboard"></i> Contratos</a></li>
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
                <a href="{{ url('/contratacionproyectos/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/contratacionproyectos?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/contratacionproyectos?estado=2') }}" class="btn btn-primary">Papelera</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>N°</th>
                  <th>Empleado</th>
                  <th>Proyecto</th>
                  <th>Cargo</th>
                  <th>Salario</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($contrataciones as $key => $contratacion)
                  <tr>
                    <td>{{ $key+1}}</td>
                    <td>{{ $contratacion->empleado->nombre }}</td>
                    <td>{{ $contratacion->contratoproyecto->proyecto->nombre }}</td>
                    <td>{{ $contratacion->cargo }}</td>
                    <td>{{ $contratacion->salario }}</td>

                    <td>

                        {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                          <div class="btn-group">
                            <a href="{{ url('contratacion/'.$contratacion->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="{{ url('contratacion/'.$contratacion->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>

                            <a class="btn btn-primary btn-xs" target="_blank" href="{{ url('reportesuaci/contratoproyecto/'.$contratacion->id) }}"><i class="fa fa-file-pdf-o"></i></a>
                            <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$contratacion->id.",'contratacion')" }}><span class="glyphicon glyphicon-trash"></span></button>
                          </div>
                        {{ Form::close()}}

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
