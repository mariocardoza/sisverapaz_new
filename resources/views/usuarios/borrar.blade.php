@extends('layouts.app')
@section('migasdepan')
<h1>
        Usuarios
        <small>Eliminar usuario {{ $usuario->name }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/usuarios') }}"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li class="active">Registro</li>
      </ol>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro de Usuarios</div>
                <div class="panel-body">
                	{{-- {{ Form::model($usuario,['method' => 'put', 'route' => ['usuarios.update',$usuario->id]] )}} --}}
                   {{ Form::open(['action' => 'UsuariosController@destroy','method' => 'put','class' => 'form-horizontal']) }} 
                    {{-- <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}"> --}}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input type="hidden" name="id" id="id" value="{{ $usuario->id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Esta seguro que desea eliminar el registro {{ $usuario->name }}</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>    ELiminar
                                </button>
                                <button type="button" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>    Cancelar                   
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