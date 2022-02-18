@extends('layouts.app')
@section('migasdepan')
<h1>
	Registro de Categoría
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/categorias') }}"><i class="fa fa-dashboard"></i>Categoría</a></li>
</ol>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">Categoría</div>
				<div class="panel-body">
					{{ Form::open(['action'=>'CategoriaController@store','class' => 'form-horizontal']) }}
					@include('categorias.formulario')

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-success">
								<span class="glyphicon glyphicon-floppy-disk">Registrar</span>
							</button>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection