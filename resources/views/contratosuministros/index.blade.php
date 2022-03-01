@extends('layouts.app')

@section('migasdepan')
<h1>
        Contratos de Suministro
        <small>Control de contratos</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratosuministros') }}"><i class="fa fa-dashboard"></i> Contratos</a></li>
        <li class="active">Listado de contratos</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/contratosuministros/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/contratosuministros?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/contratosuministros?estado=2') }}" class="btn btn-primary">Papelera</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Nombre contrato</th>
                  <th>Proveedor</th>
                  <th>Fecha de contrato</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($contratosuministros as $contratosuministro)
                  <tr>
                    <td>{{ $contratosuministro->id }}</td>
                    <td>{{ $contratosuministro->requisicion->nombre }}</td>
                    <td>{{ $contratosuministro->proveedor->nombre }}</td>
                    <td>{{ $contratosuministro->fecha_contratacion }}</td>
                    
                    <td>
                      @if($estado == 1 || $estado == "")
                        {{ Form::open(['method' => 'POST', 'id' => 'baja', 'class' => 'form-horizontal'])}}
                          <a href="{{ url('contratosuministros/'.$contratosuministro->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                          <a href="{{ url('contratosuministros/'.$contratosuministro->id.'/edit') }}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-text-size"></span></a>
                          <button class="btn btn-danger btn-xs" type="button" onclick={{ "baja(".$contratosuministro->id.",'contratosuministros')" }}><span class="glyphicon glyphicon-trash"></span></button>
                        {{ Form::close()}}
                      @else
                        {{ Form::open(['method' => 'POST', 'id' => 'alta', 'class' => 'form-horizontal'])}}
                          <button class="btn btn-success btn-xs" type="button" onclick={{ "alta(".$contratosuministro->id.",'contratosuministros')" }}><span class="glyphicon glyphicon-trash"></span></button>
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
