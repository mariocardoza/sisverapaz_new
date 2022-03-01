@extends('layouts.app')

@section('migasdepan')
<h1>
        Organizaciones
        <small>Control de organizaciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/organizaciones') }}"><i class="fa fa-dashboard"></i> Organizaciones</a></li>
        <li class="active">Listado de organizaciones</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/organizaciones/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Organización</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Representante</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @foreach($organizaciones as $organizacion)
                  <tr>
                    <td>{{ $organizacion->id }}</td>
                    <td>{{ $organizacion->nombre_org }}</td>
                    <td>{{ $organizacion->direccion_org }}</td>
                    <td>{{ $organizacion->telefono_org }}</td>
                    <td>{{ $organizacion->representante_org }}</td>
                    <td>
                                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                                <a href="{{ url('organizaciones/'.$organizacion->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="{{ url('/organizaciones/'.$organizacion->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$organizacion->id.",'organizaciones')" }}><span class="glyphicon glyphicon-trash"></span></button>
                                {{ Form::close()}}

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
