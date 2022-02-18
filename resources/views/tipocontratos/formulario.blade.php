                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Tipo de contrato</label>

                            <div class="col-md-6">

                                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre_tipo','autofocus'])!!}

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
