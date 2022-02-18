@extends('layouts.app')

@section('migasdepan')
<h1>
        Generalidades del contrato del proyecto

      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratoproyectos') }}"><i class="fa fa-dashboard"></i> Generalidades del contrato</a></li>
        <li class="active">Ver</li>      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de contrato</div>
                <div class="panel-body">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Proyecto</th>
                        <td>{{$contratoproyecto->proyecto->nombre}}</td>
                      </tr>
                      <tr>
                        <th>administrador del contrato</th>
                        <td>{{$contratoproyecto->admin_contrato}}</td>
                      </tr>
                      <tr>
                        <th>Motivo del contrato</th>
                        <td>{{$contratoproyecto->motivo_contratacion}}</td>
                      </tr>
                      <tr>
                        <th>Fecha de inicio del contrato</th>
                        <td>{{fechaCastellano($contratoproyecto->inicio_contrato)}}</td>
                      </tr>
                      <tr>
                        <th>Fecha de finalización del contrato</th>
                        <td>{{fechaCastellano($contratoproyecto->fin_contrato)}}</td>
                      </tr>
                      <tr>
                        <th>Hora de entrada</th>
                        <td>{{$contratoproyecto->hora_entrada}}</td>
                      </tr>
                      <tr>
                        <th>Hora de salida</th>
                        <td>{{$contratoproyecto->hora_salida}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
