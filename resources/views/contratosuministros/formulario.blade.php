<div class="form-group{{ $errors->has('proveedor_id') ? ' has-error' : '' }}">
	<label for="" class="col-md-4 control-label">Proveeder</label>
	<div class="col-md-6">
		<select name="proveedor_id" id="proveedor" class="form-control">
			<option value="">Seleccione</option>
			@foreach($proveedores as $proveedor)
			<option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
			@endforeach
		</select>
		@if ($errors->has('proveedor_id'))
		<span class="help-block">
			<strong>{{ $errors->first('proveedor_id') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('requisicion_id') ? ' has-error' : '' }}">
	<label for="" class="col-md-4 control-label">Requisición</label>
	<div class="col-md-6">
		<select name="requisicion_id" id="requisicion" class="form-control">
			<option value="">Seleccione</option>
			@foreach($requisiciones as $requisicion)
			<option value="{{$requisicion->id}}">{{$requisicion->nombre}}</option>
			@endforeach
		</select>
		@if ($errors->has('requisicion_id'))
		<span class="help-block">
			<strong>{{ $errors->first('requisicion_id') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{$errors->has('fecha_contratacion') ? 'has-error' : '' }}">
	<label for="fecha_contratacion" class="col-md-4 control-label">Fecha de contratación</label>

	<div class="col-md-6">
		{{ Form::date('fecha_contratacion', null, ['class' => 'form-control']) }}
		@if ($errors->has('fecha_contratacion'))
		<span class="help-block">
			<strong>{{ $errors->first('fecha_contratacion') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{$errors->has('inicio_contrato') ? 'has-error' : '' }}">
	<label for="inicio_contrato" class="col-md-4 control-label">Inicio de contrato</label>

	<div class="col-md-6">
		{{ Form::date('inicio_contrato', null, ['class' => 'form-control']) }}
		@if ($errors->has('inicio_contrato'))
		<span class="help-block">
			<strong>{{ $errors->first('inicio_contrato') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{$errors->has('fecha_revision') ? 'has-error' : '' }}">
	<label for="fecha_revision" class="col-md-4 control-label">Fecha de revisión</label>

	<div class="col-md-6">
		{{ Form::date('fecha_revision', null, ['class' => 'form-control']) }}
		@if ($errors->has('fecha_revision'))
		<span class="help-block">
			<strong>{{ $errors->first('fecha_revision') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{$errors->has('fecha_contratacion') ? 'has-error' : '' }}">
	<label for="fecha_contratacion" class="col-md-4 control-label">Fecha de contratación</label>

	<div class="col-md-6">
		{{ Form::date('fecha_contratacion', null, ['class' => 'form-control']) }}
		@if ($errors->has('fecha_contratacion'))
		<span class="help-block">
			<strong>{{ $errors->first('fecha_contratacion') }}</strong>
		</span>
		@endif
	</div>
</div>