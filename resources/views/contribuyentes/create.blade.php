@extends('layouts.app')

@section('migasdepan')
<h1>
        Proveedor
        <small>Control de Proveedor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/contribuyentes') }}"><i class="fa fa-dashboard"></i> Proveedor</a></li>
        <li class="active">Registro</li>      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de contribuyente</div>
                <div class="panel-body">
                    {{ Form::open(['action' => 'ContribuyenteController@store','class' => 'form-horizontal']) }}
                        @include('errors.validacion')
                        @include('contribuyentes.formulario')

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
