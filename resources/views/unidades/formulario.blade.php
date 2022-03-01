<div class="form-group{{ $errors->has('nombre_unidad') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Digite el nombre de la unidad administrativa</label>

    <div class="col-md-6">
        {!!Form::text('nombre_unidad',null,['class'=>'form-control','id'=>'nombre_unidad','autofocus'])!!}
    </div>
</div>