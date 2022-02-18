<div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
    <label for="" class="col-md-4 control-label">Categoría</label>

        <div class="col-md-6">
          <select name="organizacion_id" id="organizacion" class="form-control" >
          </select>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-primary" name="button" id="" data-toggle="modal" data-target="#btnorganizacion"><span class="glyphicon glyphicon-plus"></span></button>
        </div>
</div>

  <div class="form-group">
    <label for="" class="col-md-4 control-label">Ingrese el monto</label>
    <div class="col-md-6">
      <input type="number" id="cant_monto_org" class="form-control" step="0.00" min="0.00">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" type="button" id="btnAgregarfondo_org">Agregar</button>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" id="tbFondosorg">
            <thead>
            <tr>
                <th>Organización</th>
                <th>Monto</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody id="cuerpo_org"></tbody>
            <tfoot id="pie_fondoorg">
                <tr>
                    <td class="text-left" colspan="2">Total $</td>
                    <td colspan="2" style="text-align:right;" id="totalEndorg">0.00</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
