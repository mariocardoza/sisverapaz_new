<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoRequisicione extends Model
{
    protected $dates = ['created_at'];
    protected $guarded=[];

    public static function mostrar_contratos($id)
    {
        try{
            $contratos=ContratoRequisicione::where('requisicion_id',$id)->orderBy('created_at','asc');
            $requisicion=Requisicione::find($id);
            $html='';
            if(count($requisicion->contratorequisicion) > 0):
            $html.='<br>
            <button title="Agregar contrato" class="btn btn-success pull-right" id="subir_contrato" type="button">Agregar</button>
              <table class="table" id="latabla">
                <thead>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </thead>
                <tbody>';
                  foreach($requisicion->contratorequisicion as $index => $contrato):
                    $html.='<tr>
                    <td>'.($index+1).'</td>
                    <td>'.$contrato->nombre.'</td>
                    <td>'.$contrato->descripcion.'</td>
                    <td>'.$contrato->created_at->format('d/m/Y').'</td>
                    <td>
                    <div class="btn-group">
                      <a href="../contratorequisiciones/bajar/'.$contrato->archivo.'" id="descargar_contrato" target="_blank" data-id="'.$contrato->id.'" title="Descargar contrato" class="btn btn-success"><i class="fa fa-download"></i></a>
                      <a href="javascript:void(0)" id="quitar_contrato" data-id="'.$contrato->id.'" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                    </td>
                    </tr>';
                  endforeach;
                $html.='</tbody>
              </table>';
            else:
              if($requisicion->estado==2):
                $html.='<h4 class="text-yellow text-center"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
              <center><span class="text-center">La requisición fue rechazada</span><br>
              </center>';
              elseif($requisicion->estado==1):
                $html.='<h4 class="text-yellow text-center"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
              <center><span class="text-center">La requisición no ha sido aprobada</span><br>
              </center>';
              else:
                $html.='<h4 class="text-yellow text-center"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
              <center><span class="text-center">Aún no ha registrado ningún contrato</span><br><br>
              <button class="btn btn-success btn-sm" id="subir_contrato" type="button">Registrar</button>
              </center>';
              endif;
            endif;
            return array(1,"exito",$html);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }
}
