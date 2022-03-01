@extends('layouts.app')

@section('migasdepan')
<h1>
        Cotizaciones
        <small>Control de cotizaciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/cotizaciones') }}"><i class="fa fa-dashboard"></i> Cotizaciones</a></li>
        <li class="active">Listado de cotizaciones</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
                <a href="{{ url('/cotizaciones/create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Agregar</a>
                <a href="{{ url('/cotizaciones?estado=1') }}" class="btn btn-primary">Activos</a>
                <a href="{{ url('/cotizaciones?estado=2') }}" class="btn btn-primary">Papelera</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example2">
          <thead>
                  <th>Id</th>
                  <th>Nombre del proyecto</th>
                  <th>Monto</th>
                  <th>Estado</th>
                  <th>Accion</th>
                </thead>
                <tbody>
                  @foreach($proyectos as $proyecto)
                  <tr>
                    <td>{{$proyecto->id}}</td>
                    <td>{{$proyecto->nombre}}</td>
                    <td>${{number_format($proyecto->monto,2)}}</td>
                    <td><span class="label-warning">{{proyecto_estado($proyecto->estado)}}</span></td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="{{url('cotizaciones/ver/'.$proyecto->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a>
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
