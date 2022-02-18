@extends('layouts.app')

@section('migasdepan')
<h1>
	<small>Ver Organización<b> {{$organizaciones->nombre}} </b></small>
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/organizaciones') }}"><i class="fa fa-dashboard"></i> Organizaciones</a></li>
	<li class="active">Ver</li>
</ol>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Datos de la organización</div>
				<div class="panel-body">
					<div class="form-group {{ $errors->has('nombre') ? ' has-error ' : '' }}">
						<label for="nombre" class="col-md-4 control-label">Nombre de la organización</label>
						<label for="nombre" class="col-md-4 control-label">{{$organizaciones->nombre}}</label><br>
					</div>

					<div class="form-group {{ $errors->has('direccion') ? ' has-error ' : '' }}">
						<label for="direccion" class="col-md-4 control-label">Dirección de la organización</label>
					</div>

					<div class="form-group {{ $errors->has('telefono') ? ' has-error ' : '' }}">
						<label for="telefono" class="col-md-4 control-label">Teléfono de la organización</label>
					</div>

					 <div class="form-group {{ $errors->has('representante') ? ' has-error ' : '' }}">
					 	<label for="representante" class="col-md-4-label">Representante</label>
					 </div>

					 <div class="form-group {{ $errors->has('tel_representante') ? ' has-error ' : '' }}">
					 	<label for="tel_representante" class="col-md-4-label">Teléfono representante</label>
					 </div>
					 {{Form::open(['route' => ['organizaciones.destroy', $organizaciones->id], 'method' => 'DELETE', 'class' => 'form-horizontal'])}}
					 <a href="{{ url('/organizaciones/'.$organizaciones->id.'/edit') }}" class="btn btn-warning"> <span class="glyphicon glyphicon-text-size"></span> Editar</a> |
					 <button class="btn btn-danger" type="button" onclick="return
					 swal({
					 title: 'Eliminar organización',
					 text: '¿Está seguro de eliminar el registro?',
					 type: question,
					 showCancelButton: true,
					 confirmButtonText: 'Sí, eliminar',
					 cancelButtonText: 'No, mantener',
					 confirmButtonClass: 'btn btn-danger',
					 cancelButtonClass: 'btn btn-default',
					 buttonsStyling: false
					}).then(function (){
					submit();
					swal('Hecho', 'El registro ha sido eliminado', 'success')
				}, function(dismiss){
				if(dismiss == 'cancel'){
				swal('Cancelado', 'El registro se mantiene', 'info')
			}
			});"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
			{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection