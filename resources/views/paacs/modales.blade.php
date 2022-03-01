<!-- Modal -->
<?php
use Carbon\Carbon;
$date = Carbon::now();
$date = $date->format('Y');
$paacsitos=[];
$lospaacs=App\PaacCategoria::where('estado',1)->get();
foreach($lospaacs as $p){
  $paacsitos[$p->id]=$p->nombre;
}
?>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Registrar Nuevo Plan</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(['class' => '','id' => 'form_paac']) }}
              
              <input type="hidden" name="total" id="total" value="0.00" readonly>
              <div class="form-group">
                <label for="" class="control-label">Descripcion Plan Anual</label>
                  <div class="">
                    <textarea class="form-control" name="nombre"></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label for="" class="control-label">
                      Año
                  </label>
                  <div>
                        <input type="number" name="anio" class="form-control" value="<?= $date; ?>" >
                  </div>
              </div>
              {{Form::close()}}
            </div>
            <div class="modal-footer">
              <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <button type="button" id="registrar_paac" class="btn btn-success">Guardar</button></center>
            </div>
          </div>
          </div>
        </div>