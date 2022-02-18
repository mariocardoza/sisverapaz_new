@extends('layouts.app')

@section('migasdepan')
<h1>
        Modificar imagen de perfil
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
        <li><a href="{{ url('/home/perfil') }}"><i class="fa fa-address-card"></i> Perfil</a></li>
        <li class="active">Imagen de Perfil</li>
      </ol>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de Usuarios</div>
                <div class="panel-body">
				<h1>Cambiar imagen de perfil</h1>
				<img src="{{ asset('avatars/'.Auth::user()->avatar) }}" width="150" height="200" class="user-image" alt="User Image">
				<form method='post' action='{{url("usuarios/updateprofile")}}' enctype='multipart/form-data'>
					{{csrf_field()}}
					<div class='form-group'>
						<label for='image'>Imagen: </label>
						<input type="file" name="avatar" />
						<div class='text-danger'>{{$errors->first('avatar')}}</div>
					</div>
					<button type='submit' class='btn btn-primary'>Actualizar imagen de perfil</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
