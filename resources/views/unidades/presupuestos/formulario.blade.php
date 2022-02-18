                        <div class="form-group">
                          <label for="" class="col-md-4 control-label">Seleccione una unidad</label>
                            <div class="col-md-6">
                              @if(isset($unidades))
                                <select id="unidad_admin" class="form-control chosen-select">
                                    <option value="">Seleccione una unidad administrativa...</option>
                                    @foreach($unidades as $unidad)
                                      <option value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
                                    @endforeach
                                </select>
                              @else
                                {!!Form::hidden('unidad',$unidad->id)!!}
                              @endif
                            </div>
                        </div>

                      <div class="form-group">
                            <div class="col-md-12">
                            <label for="" class="col-md-4 control-label"><b>Necesidades</b></label>
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-md-4 control-label">Descripción</label>
                            <div class="col-md-6">
                                {!! Form::text('',null,['class' => 'form-control','id' => 'descripcion']) !!}
                            </div>
                      </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-2">
                                <label for="" class="col-md-1 control-label">Cantidad</label>
                                {!!Form::number('',null,['class' => 'form-control','id' => 'cantidad','min' => 1,'steps' => 1])!!}
                            </div>
                            <div class="col-md-3">
                                <label for="" class="control-label">Precio Unitario</label>
                                {!!Form::number('',null,['class' => 'form-control','id' => 'precio','min' => 1,'steps' => 0.00])!!}
                            </div>
                            <div class="col-md-3">
                                <label for="" class="control-label">Unidad de medida</label>
                                {!! Form::text('',null,['class' => 'form-control','id' => 'unidad_medida']) !!}
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="button" id="agregar" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
