<div class="form-group{{ $errors->has('nombre_cobro') ? ' has-error' : '' }}">
    <label for="nombre_cobro" class="col-md-4 control-label">Tipo de cobro</label>

    <div class="col-md-6">

        {!!Form::text('nombre_cobro',null,['class'=>'form-control','id'=>'nombre_cobro','autofocus'])!!}

        @if ($errors->has('nombre_cobro'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre_cobro') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('monto') ? ' has-error' : '' }}">
    <label for="monto" class="col-md-4 control-label">Monto del cobro</label>

    <div class="col-md-6">

        {!!Form::text('monto',null,['class'=>'form-control','id'=>'monto','autofocus'])!!}

        @if ($errors->has('monto'))
            <span class="help-block">
                <strong>{{ $errors->first('monto') }}</strong>
            </span>
        @endif
    </div>
</div>