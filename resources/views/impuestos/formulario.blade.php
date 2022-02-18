<div class="form-group{{ $errors->has('tiposervicio_id') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Servicio Municipal</label>

    <div class="col-md-6">

        <select name="tiposervicio_id" id="" class="form-control">
            @foreach($tiposervicios as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
            @endforeach
        </select>

        @if ($errors->has('tiposervicio_id'))
            <span class="help-block">
                <strong>{{ $errors->first('tiposervicio_id') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('impuesto') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Impuesto a aplicar</label>

    <div class="col-md-6">

        {!!Form::text('impuesto',null,['class'=>'form-control','id'=>'impuesto','autofocus'])!!}

        @if ($errors->has('impuesto'))
            <span class="help-block">
                <strong>{{ $errors->first('impuesto') }}</strong>
            </span>
        @endif
    </div>
</div>