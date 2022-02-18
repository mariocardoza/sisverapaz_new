<div class="form-group{{ $errors->has('nombre_org') ? ' has-error' : '' }}">
    <label for="nombre_org" class="col-md-4 control-label">Nombre de organización</label>

    <div class="col-md-6">
        {{ Form::text('nombre_org', null,['class' => 'form-control', 'id'=>'nombre_org']) }}
    </div>
</div>

<div class="form-group{{ $errors->has('direccion_org') ? 'has-error' : '' }}">
	<label for="direccion_org" class="col-md-4 control-label">Dirección</label>

	<div class="col-md-6">
		{{ Form::textarea('direccion_org', null,['class' => 'form-control', 'rows' => 3, 'id'=>'direccion_org']) }}
	</div>
</div>

<div class="form-group{{$errors->has('telefono_org') ? 'has-error' : '' }}">
	<label for="telefono_org" class="col-md-4 control-label">Teléfono</label>

	<div class="col-md-6">
		{{ Form::text('telefono_org', null, ['class' => 'form-control', 'data-inputmask' => '"mask": "9999-9999"','data-mask', 'id'=>'telefono_org']) }}
	</div>
</div>

<div class="form-group{{$errors->has('representante_org') ? 'has-error' : '' }}">
	<label for="representante_org" class="col-md-4 control-label">Nombre representante</label>

	<div class="col-md-6">
		{{ Form::text('representante_org', null, ['class' => 'form-control', 'id'=>'representante_org']) }}
	</div>
</div>

<div class="form-group{{$errors->has('tel_representante_org') ? 'has-error' : '' }}">
	<label for="tel_representante_org" class="col-md-4 control-label">Teléfono representante</label>

	<div class="col-md-6">
		{{ Form::text('tel_representante_org', null, ['class' => 'form-control', 'data-inputmask' => '"mask": "9999-9999"','data-mask', 'id'=>'tel_representante_org']) }}
	</div>
</div>