<div class="form-group{{ $errors->has('evento') ? ' has-error' : '' }}">
    <label for="evento" class="col-md-4 control-label">Nombre del evento</label>

    <div class="col-md-6">
        {{ Form::text('evento', null,['id'=>'evento','class' => 'form-control']) }}

        @if ($errors->has('evento'))
            <span class="help-block">
                <strong>{{ $errors->first('evento') }}</strong>
            </span>
         @endif
    </div>
</div>

<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
    <label for="descripcion" class="col-md-4 control-label">Descripción evento</label>

    <div class="col-md-6">
        {{ Form::text('descripcion', null,['id'=>'descripcion','class' => 'form-control']) }}

        @if ($errors->has('descripcion'))
            <span class="help-block">
                <strong>{{ $errors->first('descripcion') }}</strong>
            </span>
         @endif
    </div>
</div>
