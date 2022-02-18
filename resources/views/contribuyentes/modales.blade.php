@php
    $categoriarubros=App\CategoriaRubro::get();
@endphp
<div class="modal fade" tabindex="-1" id="modal_rubros" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Rubros</h4>
        </div>
        <div class="modal-body">
            <form id="form_rubro" action="" class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success" id="nuevo_rubro" title='Agregar nuevo rubro'>
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </div>
                        <table class="table tbrubro" id="example2">
                            <thead>
                                <th>N°</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Porcentaje</th>
                                <th>Formula</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></center>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_servicios" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Servicios</h4>
      </div>
      <div class="modal-body">
          <form id="form_servicio" action="" class="form-horizontal">
              <div class="row">
                  <div class="col-md-12">
                      <div class="btn-group pull-right">
                          <button type="button" class="btn btn-success" id="nuevo_servicio" title='Agregar nuevo servicio'>
                              <i class="fa fa-plus-circle"></i>
                          </button>
                      </div>
                      <table class="table tbservicio" id="example2">
                          <thead>
                              <th>N°</th>
                              <th>Nombre</th>
                              <th>Costo</th>
                              <th>Tipo cobro</th>
                              <th>Estado</th>
                              <th>Acciones</th>
                          </thead>
                          <tbody>

                          </tbody>
                      </table>
                  </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_contribuyente" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Agregar Nuevo Contribuyente</h4>
      </div>
      <div class="modal-body">
          <form id="form_contribuyente" class="">
              <div class="row">
                  <div class="col-md-12">
                    @include('contribuyentes.formulario')
                  </div>
            </div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button></center>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_mapainmueble" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ubicación del inmueble</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="elidinmueble">
          <div id="elmapaimueble" style="height: 300px;"></div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_mapanegocio" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ubicación del negocio</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="elidnegocio">
          <div id="elmapanegocio" style="height: 300px;"></div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_inmueble" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Agregar Inmueble</h4>
      </div>
      <div class="modal-body">
          <form id="form_inmueble" class="">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label"># Catastral</label>
                    <input type="text" name="numero_catastral" autocomplete="off" placeholder="Digite el número catastral" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="control-label">Ancho inmueble (mts)</label>
                        <input type="number" step="any" name="ancho_inmueble" placeholder="Digite el ancho" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="" class="control-label">Largo inmueble (mts)</label>
                        <input type="number" step="any" name="largo_inmueble" placeholder="Digite el largo" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label"># Escritura</label>
                    <input type="text" name="numero_escritura" autocomplete="off" placeholder="Digite el número de escritura" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Metros de acera</label>
                    <input type="number" step="any" name="metros_acera" autocomplete="off" placeholder="Digite la longitud de la acera (mts)" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="lat" id="lat">
                  <input type="hidden" name="lng" id="lng">
                  <input type="hidden" name="contribuyente_id" value="{{empty($c)  ? '' : $c->id}}">

                  <div class="form-group">
                    <label for="" class="control-label">Dirección</label>
                    <textarea class="form-control" name="direccion_inmueble" id="direcc" rows="2"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="elmapitainmueble" style="height:350px;"></div>
                </div>
            </div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Guardar</button></center>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_negocio" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title-negocio" id="gridSystemModalLabel">Agregar Negocio</h4>
      </div>
      <div class="modal-body">
          <form id="form_negocio" class="">
            <input type="hidden" name="negocio_id" id="n_id">
              <div class="row">
                <div class="col-md-12" style="text-align: center;">
                  <div class="btn-group" data-toggle="buttons">
                      <label class="btn btn-primary active">
                        <input type="radio" name="tipo_cobro" value="1" id="capitall" checked> Capital
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="tipo_cobro" value="2" id="licencia"> Licencia
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="tipo_cobro" value="3" id="otro"> Otro
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="tipo_cobro" value="4" id="ganado"> Ganado
                      </label>
                  </div>
              </div>
              <br><br><br>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Nombre</label>
                    <input type="text" name="nombre" id="n_negocio" autocomplete="off" placeholder="Digite el nombre del negocio" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label tipo_cobro_text">Capital</label>
                    <input type="number" name="capital" placeholder="Digite el capital inicial" class="form-control tipo_cobro_field">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Categoría de rubros</label>
                    <select name="categoriarubro_id" id="categoriarubro_id" class="chosen-select-width">
                      <option value="">Seleccione una categoría de rubro</option>
                      @foreach ($categoriarubros as $r)
                          <option value="{{$r->id}}">{{$r->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="" class="control-label">Rubros</label>
                    <select name="rubro_id" id="rubro_id" class="chosen-select-width">
                      <option value="">Seleccione un rubro</option>
                      
                    </select>
                  </div>
                </div>
                <div class="col-md-6 ganado" style="display: none;">
                  <div class="form-group">
                    <label for="" class="control-label">Número de cabezas</label>
                    <input type="number" name="numero_cabezas" id="n_cabezas" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 ganado" style="display: none;">
                  <div class="form-group">
                    <label for="" class="control-label">Precio cabezas (fijo anual) </label>
                    <input type="number" step="any" name="precio_cabezas" id="p_cabezas" class="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="" class="control-label">Dirección</label>
                    <textarea name="direccion" id="direcc_negocio" rows="2" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="lat" id="latnegocio">
                  <input type="hidden" name="lng" id="lngnegocio">
                  <input type="hidden" name="contribuyente_id" value="{{empty($c) ? '' : $c->id}}">
                </div>
                <div class="col-md-12">
                  <div id="elmapitanegocio" style="height:350px;"></div>
                </div>
            </div>
          
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success text-button">Guardar</button>
        <button type="button" class="btn btn-success submit_editarnegocio" style="display: none;">Editar</button>
      </center>
      </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" id="modal_servicios_inmueble" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Impuestos para inmueble: </h4>
      </div>
      <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="btn-group pull-right">
                          <button type="button" class="btn btn-primary" id="nuevo_impuesto" title='Agregar nuevo impuesto'>
                              <i class="fa fa-plus-circle"></i>
                          </button>
                      </div><br><br>
                      <div id="eldiv_agregar_impuesto" style="display: none;">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Agregar nuevo impuesto</div>
                          <div class="panel-body">
                            <div class="form-group">
                              <label for="" class="control-label">Servicio</label>
                              <select name="" id="elimpuestito" class="chosen-select-width">
                                <option value="">Seleccione un impuesto</option>
                              </select>
                              <input type="hidden" id="idinm">
                            </div>
                            <div class="form-group">
                              <button class="btn btn-danger pull-left ccc">Cancelar</button>
                              <button class="btn btn-success pull-right ggg">Agregar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <table class="table tbimpuestos" id="example2">
                          <thead>
                              <th>N°</th>
                              <th>Nombre</th>
                              <th>Pago (por unidad)</th>
                              <th>Acciones</th>
                          </thead>
                          <tbody>

                          </tbody>
                      </table>
                  </div>
            </div>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button></center>
      </div>
    </div>
  </div>
</div>