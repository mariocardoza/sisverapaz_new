@extends('layouts.app')

@section('migasdepan')
<h1>
        Bitacora
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/bitacoras') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Bitácora</li>
      </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-5 btn-group">
            <button onclick="busqueda('e');" class="btn btn-info" type="button">Empleado</button>
            <button onclick="busqueda('d');" class="btn btn-info" type="button">Día</button>
            <button onclick="busqueda('p');" class="btn btn-info" type="button">Periodo</button>
            <button onclick="location.reload();" class="btn btn-success" type="button">Limpiar</button>
          </div>
        </div>
        {{ Form::open(['action' => 'BitacoraController@general', 'method' => 'GET'])}}
        <div class="row mt-4">
            <label for="" class="cmbusuario control-label">Empleado</label>
            <label for="" class="txtdia control-label">Fecha</label>
            <div class="col-md-6">
              <select class="cmbusuario form-control" id="cmbusuario"  name="usuario">
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                  <option value="{{$usuario->id}}">{{$usuario->empleado->nombre}}</option>
                @endforeach
              </select>
              <input type="text" id="txtdia" name="dia" class="txtdia form-control">
            </div>
        </div>
        <div class="row">
          <div class="col-md-3">
              <label for="fecha_inicio" class="txtinicio control-label">Fecha de inicio</label>
              {!!Form::text('inicio',null,['class'=>'txtinicio form-control','id'=>'txtinicio'])!!}
          </div>
          <div class="col-md-3">
            <label for="fecha_fin" class="txtfin control-label">Fecha de finalización</label>
              {!!Form::text('fin',null,['class'=>'txtfin form-control','id'=>'txtfin'])!!}
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-2">
            <button class="btn btn-primary" id="consultar" type="button">Consultar</button>
          </div>
        </div>
        {{Form::close()}}
        {{Form::hidden('',$ultimo->created_at->format('Y-m-d'),['id'=>'ultimo'])}}

              
              <div class="panel-body mt-4" id="aqui_bita">
                <table class="table table-hover" id="esta">
                   <thead>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acción</th>
                    <th>Ip</th>
                    <th>URL</th>
                    <th>Tabla</th>
                    <th>Navegador</th>
                    <th>Usuario</th>
                  </thead>
                  <tbody id="bita">
                    @foreach($bitacoras as $key => $bitacora)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ fechaCastellano($bitacora->created_at) }}</td>
                      <td>{{ $bitacora->created_at->format('H:i:s') }}</td>
                      <td>{{ $bitacora->accion }}</td>
                      <td>{{ $bitacora->ip }}</td>
                      <td>{{ $bitacora->url }}</td>
                      <td>{{ $bitacora->tabla }}</td>
                      <td>{{ get_browser_name($bitacora->agent) }}</td>
                      <td>{{ $bitacora->user->empleado->nombre}}</td>
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>

          </div>
        </div>
      </div>

@endsection
@section("scripts")
{{Html::script('js/bitacora.js?cod='.date("Yidisus"))}}
@endsection
