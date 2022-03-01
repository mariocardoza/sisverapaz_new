@extends('layouts.app')
@section('migasdepan')
  <h1><small>Ver negocio <b>{{ $negocio->nombre }}</b></small></h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/negocios') }}"><i class="fa fa-dashboard"></i> Negocio</a></li>
    <li class="active">Ver</li>
  </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos del negocio </div>
                <div class="panel-body">
                  <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="col-md-4 control-label">Nombre del negocio: </label>
                    <label for="nombre" class="col-md-4 control-label">{{ $negocio->nombre }}</label><br>
                  </div>

                  <div class="form-group{{ $errors->has('porcentaje') ? ' has-error' : '' }}">
                    <label for="porcentaje" class="col-md-4 control-label">Contribuyente: </label>
                    <label for="nombre" class="col-md-4 control-label">{{ $negocio->contribuyente->nombre }}</label><br>
                  </div>

                  <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                    <label for="estado" class="col-md-4 control-label">Rubro: </label>
                    <label for="nombre" class="col-md-4 control-label">{{ $negocio->rubro->nombre }}</label><br>
                  </div>

                  <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                    <label for="estado" class="col-md-4 control-label">Direccion: </label>
                    <label for="nombre" class="col-md-4 control-label">{{ $negocio->direccion }}</label><br>
                  </div>

                  <hr />
                  <div class="col-xs-12" ng-init='position={lat:{{ $negocio->lat }}, lng: {{ $negocio->lng }}, id: {{ $negocio->id }}}' ng-controller='ApplicationControllers'>
                    <div map-lazy-load="https://maps.google.com/maps/api/js" 
                      map-lazy-load-params="[[googleMapsUrl]]" class="container-maps">
                      <ng-map center='13.6443693,-88.8701964' class="center-maps" style='height: 500px;' zoom="17">
                        <marker ng-repeat="position in positions" position="[[position.lat]], [[position.lng]]" animation="Animation.BOUNCE"></marker>
                      </ng-map>
                    </div>
                  </div>
                  {!! Html::script('js/app.js') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection