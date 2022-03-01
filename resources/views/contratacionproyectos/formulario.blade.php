<div class="form-group">
  <label for="" class="col-md-4">Proyecto</label>
  <div class="col-md-6">
    {{Form::textarea('',$proyecto->proyecto->nombre,['rows'=> 2,'class' => 'form-control','readonly'])}}
    {{Form::hidden('',$proyecto->id,['id'=>'proyecto'])}}
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4">Empleado</label>
  <div class="col-md-6">
    <select class="chosen-select-width" id="empleado">
      <option value="">Seleccione un empleado</option>
    </select>
  </div>
  <div class="col-md-2">
      <button class="btn btn-default" type="button" id="" data-toggle="modal" data-target="#btnempleado" title="Agregar nuevo empleado"><span class="glyphicon glyphicon-plus"></span></button>
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4">Cargo a desempeñar</label>
  <div class="col-md-6">
    {{Form::text('',null,['class'=>'form-control','id'=>'cargo'])}}
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4">Salario</label>
  <div class="col-md-6">
    {{Form::number('',null,['class'=>'form-control','id'=>'salario','min'=>0.01,'steps'=>0.01])}}
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4">Fecha de revisión del contrato</label>
  <div class="col-md-6">
    <?php $hoy=date('Y-m-d')?>
    {{Form::date('',null,['class'=>'form-control','id'=>'fecharevision','min'=>$hoy])}}
  </div>
</div>

<div class="form-group">
  <label for="" class="col-md-4">Funciones</label>
  <div class="col-md-6">
    {{Form::textarea('',null,['class' => 'form-control','id'=>'txtfuncion','rows'=>2])}}
  </div>
  <div class="col-md-1">
    <button type="button" id="agregarf" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
  </div>
</div>

<div class="form-group">
  <ol id="funciones">

  </ol>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="btnempleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Registro de Empleado
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="panel-body">
                    @include('empleados.formulario')
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardarempleado" data-dismiss="modal" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="verinformacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Información del contrato
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="panel-body">
                  <table class="table">
                    <tr>
                      <th>Proyecto</th>
                      <td >{{$proyecto->proyecto->nombre}}</td>
                    </tr>
                    <tr>
                      <th>Fecha de inicio del proyecto</th>
                      <td>{{fechaCastellano($proyecto->proyecto->fecha_inicio)}}</td>
                    </tr>
                    <tr>
                      <th>Fecha de finalización del proyecto</th>
                      <td>{{fechaCastellano($proyecto->proyecto->fecha_fin)}}</td>
                    </tr>
                    <tr>
                      <th>Nombre del empleado</th>
                      <td id="nomemp"></td>
                    </tr>
                    <tr>
                      <th>Cargo a desempeñar</th>
                      <td id="vercargo"></td>
                    </tr>
                    <tr>
                      <th>Salario mensual</th>
                      <td id="sal">${{number_format($proyecto->salario,2)}}</td>
                    </tr>
                    <tr>

                      <td>
                        <label for="">Funciones que desempeñará</label>
                      </td>
                      <td>
                        <div class="table-responsive">
                        <table class="table table-responsive">
                          <thead>
                            <tr>
                              <th>N°</th>
                              <th>Función</th>
                            </tr>
                          </thead>
                          <tbody id=cuerpito>

                          </tbody>
                        </table>
                        </div>
                      </td>

                    </tr>
                    <tr>
                      <th>Fecha de revision</th>
                      <td id=fecharev></td>
                    </tr>
                    <tr>
                      <th>Inicio del contrato</th>
                      <td id="inicontrato"></td>
                    </tr>
                    <tr>
                      <th>Fin del contrato</th>
                      <td id="fincontrato"></td>
                    </tr>
                    <tr>
                      <th>Hora de entrada</th>
                      <td id="horae"></td>
                    </tr>
                    <tr>
                      <th>Hora de salida</th>
                      <td id="horas"></td>
                    </tr>
                  </table>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
