@extends('layouts.app')

@section('migasdepan')
<h1>
        Usuarios
        <small>Ver Perfil</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li class="active">Perfil</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos del usuario </div>
                <div class="panel-body">
                        <div class="form-group{{ $errors->has('nombree') ? ' has-error' : '' }}">
                            <label for="nombree" class="col-md-4 control-label">Nombre: </label>
                            <label for="nombree" class="col-md-4 control-label">{{Auth::user()->name}}</label><br>

                        </div>

                         <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Nombre de Usuario: </label>
                            <label for="nombree" class="col-md-4 control-label">{{Auth::user()->username}}</label><br>

                        </div>

                        <div class="form-group{{ $errors->has('telefonoe') ? ' has-error' : '' }}">
                            <label for="telefonoe" class="col-md-4 control-label">Email: </label>
                            <label for="nombree" class="col-md-4 control-label">{{Auth::user()->email}}</label><br>

                        </div>

                        <div class="form-group{{ $errors->has('emailr') ? ' has-error' : '' }}">
                            <label for="emailr" class="col-md-4 control-label">Cargo:</label>
                            <label for="nombree" class="col-md-4 control-label">{{vercargo(Auth::user()->cargo)}}</label><br>

                        </div>

                        <a href="{{ url('/perfil/'.Auth::user()->id) }}" class="btn btn-warning">Editar</a> |
                        <a href="{{ url('/avatar') }}" class="btn btn-warning">Cambiar Imagen de perfil</a> |
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
