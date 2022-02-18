                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre del rubro</label>

                            <div class="col-md-6">

                                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','autofocus'])!!}

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                         <div class="form-group{{ $errors->has('porcentaje') ? ' has-error' : '' }}">
                            <label for="porcentaje" class="col-md-4 control-label">Porcentaje de impuesto</label>

                            <div class="col-md-6">
                                {!!Form::text('porcentaje',null,['class'=>'form-control','id'=>'porcentaje','autofocus'])!!}

                                @if ($errors->has('porcentaje'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('porcentaje') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>