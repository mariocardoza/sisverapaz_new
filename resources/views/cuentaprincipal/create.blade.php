@extends('layouts.app')

@section('migasdepan')
<h1>
	Registro de cuentas
</h1>
<ol class="breadcrumb">
	<li><a href="{{ url('/cuentas') }}"><i class="fa fa-dashboard"></i>Catalogo</a></li>
	<li class="active">Registro</li> </ol>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Cuentas</div>
				<div class="panel-body">
          @if($cuenta != null)
            {{ Form::model($cuenta, array('method' => 'put', 'class' => 'form-horizontal' , 'route' => array('cuentaprincipal.update', $cuenta->id))) }}
          @else
            {{ Form::open(['action'=> 'CuentaprincipalController@store', 'class' => 'form-horizontal']) }}
          @endif
          <?php
          use Carbon\Carbon;
          $date = Carbon::now();
          $date = $date->format('Y');
          ?>
          <input type="hidden" name="anio" id="anio" value="<?= $date; ?>" readonly>
          @include('cuentaprincipal.formulario')
          @if($cuenta != null)
            <div class="form-group">
  						<div class="col-md-6 col-md-offset-4">
  							<button type="submit" class="btn btn-success">
  								<span class="glyphicon glyphicon-floppy-disk">Modificar</span>
  							</button>
  						</div>
  					</div>
          @else
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-success">
								<span class="glyphicon glyphicon-floppy-disk">Registrar</span>
							</button>
						</div>
					</div>
        @endif
          {{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
