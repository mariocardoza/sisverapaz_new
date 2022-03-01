@extends('layouts.app')

@section('migasdepan')
<h1>
        Tipo de cobros
        <small>Control de tipos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/tipocobros') }}"><i class="fa fa-dashboard"></i> Tipos</a></li>
        <li class="active">Listado de tipos de cobros</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/tipocobros/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Tipo cobro</th>
                  <th>Monto</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  @foreach($tipocobros as $tipocobro)
                  <tr>
                    <td>{{ $tipocobro->id }}</td>
                    <td>{{ $tipocobro->nombre_cobro }}</td>
                    <td>{{ $tipocobro->monto }}</td>
                    <td>
                                {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                                <a href="{{ url('tipocobros/'.$tipocobro->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="{{ url('/tipocobros/'.$tipocobro->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                                <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$tipocobro->id.",'tipocobros')" }}><span class="glyphicon glyphicon-trash"></span></button>
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
