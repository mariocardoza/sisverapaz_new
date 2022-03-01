@extends('layouts.app')

@section('migasdepan')
      <h1>
        Registrar empleado para el proyecto
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contratoproyectos') }}"><i class="fa fa-dashboard"></i> Contrato</a></li>
        <li class="active">Registro</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de contrato</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'EPContratacionController@store','class' => 'form-horizontal']) }}
                        @include('errors.validacion')
                        @include('contratacionproyectos.formulario')

                        <div class="col-md-11">
                          <table class="table" >
                            <thead>
                              <tr>
                                <th>N°</th>
                                <th>Empleado</th>
                                <th>Cargo</th>
                                <th>Salario</th>
                                <th>Acción</th>
                              </tr>
                            </thead>
                            <tbody id="cuerpo">

                            </tbody>
                          </table>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="button" id="guardar" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>    Guardar
                                </button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('js/epcontratacion.js') !!}
@endsection
