<div class="form-group{{ $errors->has('numero_de_cuenta') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Número de cuenta</label>

    <div class="col-md-6">
      @if($cuenta != null)
      {{ Form::text('numero_de_cuenta', $cuenta->numero_de_cuenta,['class' => 'form-control']) }}
    @else
      {{ Form::text('numero_de_cuenta', null,['class' => 'form-control']) }}
    @endif
      @if ($errors->has('numero_de_cuenta'))
          <span class="help-block">
              <strong>{{ $errors->first('numero_de_cuenta') }}</strong>
          </span>
       @endif
    </div>
</div>

<div class="form-group{{ $errors->has('banco') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Nombre del banco</label>

    <div class="col-md-6">
      @if($cuenta != null)
        {{ Form::text('banco', $cuenta->banco,['class' => 'form-control']) }}
      @else
        {{ Form::text('banco', null,['class' => 'form-control']) }}
      @endif
        @if ($errors->has('banco'))
            <span class="help-block">
                <strong>{{ $errors->first('banco') }}</strong>
            </span>
         @endif
    </div>
</div>

<div class="form-group{{ $errors->has('monto_inicial') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Monto inicial</label>

    <div class="col-md-6">
      @if($cuenta != null)
        {{ Form::text('monto_inicial', $cuenta->monto_inicial,['class' => 'form-control']) }}
      @else
        {{ Form::text('monto_inicial', null,['class' => 'form-control']) }}
      @endif
        @if ($errors->has('monto_inicial'))
            <span class="help-block">
                <strong>{{ $errors->first('monto_inicial') }}</strong>
            </span>
         @endif
    </div>
</div>
