<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Requisicione extends Model
{
  protected $fillable = ['conpresupuesto','justificacion','id','codigo_requisicion','actividad','user_id','observaciones','unidad_id','fecha_solicitud','anio'];
  protected $primaryKey = "id";
  protected $dates= ['fecha_solicitud','fecha_baja','fecha_acta'];
  public $incrementing = false;

  public static function correlativo()
  {
    $numero=Requisicione::where('created_at','>=',date('Y'.'-1-1'))->where('created_at','<=',date('Y'.'-12-31'))->count();
    $numero=$numero+1;
    if($numero>0 && $numero<10){
      return "RQ-00".($numero)."-".date("Y");
    }else{
      if($numero >= 10 && $numero <100){
        return "RQ-0".($numero)."-".date("Y");
      }else{
        if($numero>=100){
          return "RQ-".($numero)."-".date("Y");
        }else{
          return "RQ-001-".date("Y");
        }
      }
    }
  }

  public static function estado_ver($id)
  {
    $requisicion=Requisicione::find($id);
    $html="";
    switch ($requisicion->estado) {
      case 1:
        $html.='<span class="col-xs-12 label-primary">Enviada</span>';
        break;
      case 2:
        $html.='<span class="col-xs-12 label-danger">Rechazado</span>';
        break;
      case 3:
        $html.='<span class="col-xs-12 label-info">Aceptada y recibiendo cotizaciones</span>';
        break;
      case 4:
        $html.='<span class="col-xs-12 label-info">Pendiente de realizar orden de compra</span>';
        break;
      case 5:
        $html.='<span class="col-xs-12 label-warning"><strong>Pendiente de recibir insumos</strong></span>';
        break;
      case 6:
        $html.='<span class="col-xs-12 label-success"><strong>Insumos recibidos y pendiente desembolso</strong></span>';
        break;
      case 7:
        $html.='<span class="col-xs-12 label-success"><strong>En Ejecución</strong></span>';
        break;
      case 8:
        $html.='<span class="col-xs-12 label-success"><strong>Proceso finalizado</strong></span>';
        break;
      case 9:
          $html.='<span class="col-xs-12 label-info"><strong>Combinada con otras req.</strong></span>';
          break;
      default:
        $html.='<span class="col-xs-12 label-success">Default</span>';
        break;
    }

    return $html;
  }

  public function unidad()
  {
    return $this->belongsTo('App\Unidad');
  }

  public function requisiciondetalle()
  {
    return $this->hasMany('App\Requisiciondetalle','requisicion_id');
  }

  public function solicitudcotizacion()
  {
    return $this->hasMany('App\Solicitudcotizacion','requisicion_id');
  }

  public function solicitudcotizacion_aprobadas()
  {
    return $this->hasMany('App\Solicitudcotizacion','requisicion_id')->where('estado',4);
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function cuenta()
  {
    return $this->belongsTo('App\Cuenta');
  }

  public function contratorequisicion()
  {
    return $this->hasMany('App\ContratoRequisicione','requisicion_id');
  }

  public static function tiene_materiales($id){
    $retorno=false;
    $detas=Requisiciondetalle::where('requisicion_id',$id)->get();
    foreach($detas as $deta){
      if($deta['estado']==1){
        $retorno=true;
      }
    }
    return $retorno;
  }

  public static function materiales($id)
  {
    $materiales = DB::table('materiales as m')
                  ->select('m.*','c.nombre_categoria','u.id as elid','u.nombre_medida')
                  ->join('categorias as c','m.categoria_id','=','c.id')
                  ->join('unidad_medidas as u','m.unidad_id','=','u.id')
                    ->whereNotExists(function ($query) use ($id)  {
                         $query->from('requisiciondetalles')
                            ->whereRaw('requisiciondetalles.materiale_id = m.id')
                            ->whereRaw('requisiciondetalles.requisicion_id ='.$id);
                        })->get();
    //$materiales=Materiales::where('estado',1)->get();
    $tabla='';
    $select="<option value=''>Seleccione un bien o servicio</option>";

    
    
    $tabla.='<table class="table" id="latabla">
    <thead>
      <tr>
        <th>N°</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Unidad de medida</th>
        <!--th>Cantidad</th-->
        <th></th>
      </tr>
    </thead>
    <tbody id="losmateriales">';
    foreach ($materiales as $key => $material) {
      $select.='<option data-unidad="'.$material->elid.'" value="'.$material->id.'">'.$material->nombre.'</option>';
      $tabla.='<tr>
                <td>'.($key+1).'</td>
                <td>'.$material->nombre.'</td>
                <td>'.$material->nombre_categoria.'</td>
                <td>'.$material->nombre_medida.'
                  <input type="hidden" name="materiales[]" value="'.$material->id.'"/>
                </td>
                <!--td><input type="number" class="form-control canti" name="lacantidad[]"></td-->
                <td><button type="button" data-unidad="'.$material->elid.'" data-material="'.$material->id.'" class="btn btn-primary btn-sm esteagrega" ><i class="fa fa-check"></i></button></td>
              </tr>';
    }
    $tabla.='      
    </tbody>
    </table>';

    return array(1,"exito",$tabla,$materiales,$select);
  }

  public static function presupuesto($id)
  {
    /*$materiales = DB::table('materiales as m')
                  ->select('m.*','c.nombre_categoria','u.id as elid','u.nombre_medida')
                  ->join('categorias as c','m.categoria_id','=','c.id')
                  ->join('unidad_medidas as u','m.unidad_id','=','u.id')
                    ->whereNotExists(function ($query) use ($id)  {
                         $query->from('requisiciondetalles')
                            ->whereRaw('requisiciondetalles.materiale_id = m.id')
                            ->whereRaw('requisiciondetalles.requisicion_id ='.$id);
                        })->get();*/
    $presupuesto=Presupuestounidad::where('estado',3)->where('anio',date("Y"))->where('user_id',$id)->first();
    $tabla='';
    
    $tabla.='<table class="table" id="latabla">
    <thead>
      <tr>
        <th>N°</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Unidad de medida</th>
        <th>Disponible</th>
        <!--th>Cantidad</th-->
        <th></th>
      </tr>
    </thead>
    <tbody id="losmateriales">';
    if(isset($presupuesto->presupuestodetalle)):
    foreach ($presupuesto->presupuestodetalle as $key => $material) {
      $tabla.='<tr>
                <td>'.($key+1).'</td>
                <td>'.$material->material->nombre.'</td>
                <td>'.$material->material->categoria->nombre_categoria.'</td>
                <td>'.$material->unidadmedida->nombre_medida.'
                  <input type="hidden" name="materiales[]" value="'.$material->material->id.'"/>
                </td>
                <td>'.$material->disponibles->count().'</td>
                <!--td><input type="number" class="form-control canti" name="lacantidad[]"></td-->
                <td><button type="button" data-disponible="'.$material->disponibles->count().'" data-unidad="'.$material->unidadmedida->id.'" data-material="'.$material->material->id.'" class="btn btn-primary btn-sm esteagrega" ><i class="fa fa-check"></i></button></td>
              </tr>';
    }
  endif;
    $tabla.='      
    </tbody>
    </table>';

    return array(1,"exito",$tabla,$presupuesto);
  }

  public static function descontar_presupuesto($id,$cantidad,$material_id)
  {
    $presupuesto=Presupuestounidad::where('estado',3)->where('anio',date("Y"))->where('user_id',$id)->first();
    for($i=0;$i<(int)$cantidad;$i++){
      foreach($presupuesto->presupuestodetalle as $presu){
        if($presu['material_id']==$material_id){
          $deta=\App\MaterialUnidad::where('material_id',$presu['material_id'])->where('estado',1)->first();
          $deta->estado=2;
          $deta->save();
        }
      }
    }
  }

  public static function informacion($id)
  {
    $lasoli="";
    $html="";
    $tabla="";
    try{
      $requisicion=Requisicione::find($id);
      $html.='<div class="text-center">';
      if($requisicion->enviada):
        if(Auth()->user()->hasRole('uaci')):
          if($requisicion->estado==1):
            $html.='<a title="Aprobar requisicion" href="javascript:void(0)" id="modal_aprobar" class="btn btn-primary" ><i class="fa fa-check"></i></a>';
          elseif($requisicion->estado==5 && ($requisicion->solicitudcotizacion->count() == $requisicion->solicitudcotizacion_aprobadas->count())):
            $html.='<a title="Materiales recibidos" href="javascript:void(0)" class="btn btn-primary" id="materiales_recibidos"><i class="glyphicon glyphicon-check"></i></a>';
          elseif($requisicion->estado==7):
            $html.='<a title="Finalizar" href="javascript:void(0)" class="btn btn-primary" id="terminar_proceso"><i class="fa fa-check"></i></a>';
          elseif($requisicion->estado==10):
            $html.='<a title="Descargar" href="requisiciones/bajar/'.$requisicion->nombre_archivo.'" class="btn btn-primary" id=""><i class="glyphicon glyphicon-download"></i></a>';
          else:
          endif;
        endif;
      elseif(Auth()->user()->id==$requisicion->user_id && $requisicion->estado!=2):
        $html.='<a title="Enviar requisicion a UACI" data-id="'.$requisicion->id.'" href="javascript:void(0)" id="enviar_requisicion" class="btn btn-primary" ><i class="fa fa-send"></i></a><br><br>';
      endif;
      $html.='<a title="Imprimir requisición" href="../reportesuaci/requisicionobra/'.$requisicion->id.'" title="Imprimir" class="btn btn-primary vista_previa" target="_blank"><i class="fa fa-print"></i></a>';

      $html.='</div>
      <br>
      <div class="col-sm-12">
        <span><center>'.Requisicione::estado_ver($requisicion->id).'</center></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Requisición N°:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->codigo_requisicion.'</b></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Actividad:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->actividad.'</b></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Fecha de la solicitud:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->fecha_solicitud->format('d/m/Y').'</b></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Responsable:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->user->empleado->nombre.'</b></span>
      </div>';
      if(isset($requisicion->cuenta_id)):
      $html.='<div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Fuente de financiamiento:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->cuenta->nombre.'</b></span>
      </div>';
      else:
        $html.='<div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Fuente de financiamiento:</span>
      </div>
      <div class="col-sm-12">
        <span><b>Sin definir</b></span>
      </div>';
      endif;
      $html.='<div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-sm-12">
        <span style="font-weight: normal;">Unidad solicitante:</span>
      </div>
      <div class="col-sm-12">
        <span><b>'.$requisicion->unidad->nombre_unidad.'</b></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-xs-12">
        <span style="font-weight: normal;">Justificación:</span>
      </div>
      <div class="col-xs-12">
        <span><b>'.$requisicion->justificacion.'</b></span>
      </div>';
      if($requisicion->observaciones!=''):
        $html.='<div class="clearfix"></div>
        <hr style="margin-top: 3px; margin-bottom: 3px;">
        <div class="col-xs-12">
          <span style="font-weight: normal;">Observaciones:</span>
        </div>
        <div class="col-xs-12">
          <span><b>'.$requisicion->observaciones.'</b></span>
        </div>';
      endif;
      if($requisicion->estado==2):
      $html.='<div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-xs-12">
        <span style="font-weight: normal;">Motivo por el que se rechazó:</span>
      </div>
      <div class="col-xs-12">
        <span><b>'.$requisicion->motivo_baja.' </b></span>
      </div>
      <div class="clearfix"></div>
      <hr style="margin-top: 3px; margin-bottom: 3px;">
      <div class="col-xs-12">
        <span style="font-weight: normal;">Fecha en que se rechazó:</span>
      </div>
      <div class="col-xs-12">
        <span><b>'.$requisicion->fecha_baja->format('d/m/Y').'</b></span>
      </div>';
      endif;
      $html.='<br><br>';
      if($requisicion->estado==1):
      $html.='<br><div class="text-center">
        <a href="../requisiciones/'.$requisicion->id.'/edit" title="Editar datos de requisición" class="btn btn-warning"><span class="fa fa-edit"></span></a>
        <a href="javascript:void(0)" data-id="'.$requisicion->id.'" id="quita_requi" title="Eliminar requisición" class="btn btn-danger"><span class="fa fa-trash"></span></a>
      </div>';
      endif;

      $tabla.='<div>';
      if($requisicion->requisiciondetalle->count() > 0):

          if($requisicion->estado==1):
            if($requisicion->conpresupuesto==1):
              $tabla.='<a class="btn btn-success pull-right" title="Agregar nuevo insumo" id="agregar_nueva"><span class="fa fa-plus-circle"></span></a>';
              if(Auth()->user()->hasRole('uaci')):
                $tabla.='<a class="btn btn-success pull-left" data-tabla="Requisicione" data-destinatario="'.$requisicion->user_id.'" data-id="'.$requisicion->id.'" title="Agregar comentario" id="agregar_comentario"><span class="fa fa-comments"></span></a><br>';
              endif;
            else:
              $tabla.='<center><a class="btn btn-success pull-right" id="agregar_nueva_sin">Agregar insumo</a></center><br>';
            endif;

          endif;
                $tabla.='<br><br><table class="table estee" id="tabla_requi2">
                  <thead>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Unidad de medida</th>
                    <th></th>
                  </thead>
                  <tbody>';
                    foreach($requisicion->requisiciondetalle as $detalle):
                    $tabla.='<tr>
                      <td>'.$detalle->material->nombre.'</td>
                      <td>'.$detalle->cantidad.'</td>
                      <td>'.$detalle->unidad_medida.'</td>
                      <td>';
                        if($requisicion->estado==1):
                          $tabla.='<div class="btn-group">
                            <a id="editar_detalle" data-id="'.$detalle->id.'" title="Editar insumo" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                              <button data-id="'.$detalle->id.'" id="eliminar_detalle" title="Eliminar insumo" class="btn btn-danger" type="button"><span class="fa fa-trash"></span></button>
                          </div>';
                        endif;
                      $tabla.='</td>
                    </tr>';
                      endforeach;
                  $tabla.='</tbody>
                </table>';
              else:
                if($requisicion->estado==2):
                  $tabla.='<center>
                    <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                    <span>La requisicion fue rechazada</span><br>
                  </center>';
                else:
                  if($requisicion->conpresupuesto==1):
                    $tabla.='<center>
                    <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                    <span>Agregue requerimientos de materiales</span><br><br>
                    <button class="btn btn-success" id="agregar_nueva">Agregar</button>
                  </center>';
                  else:
                    $tabla.='<center>
                    <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                    <span>Agregue requerimientos de materiales</span><br> <br>
                    <button class="btn btn-success" id="agregar_nueva_sin">Agregar</button>
                  </center>';
                  endif;
                  
                endif;
            endif;
          $tabla.='</div>';


          $lasoli.='<div>';
          if($requisicion->solicitudcotizacion->count() > 0): 
              if(Requisicione::tiene_materiales($requisicion->id)):
              $lasoli.='<center>
                <button class="btn btn-success pull-right" data-id="'.$requisicion->id.'" id="registrar_solicitud">Guardar</button>
              </center>';
              endif; 
              $lasoli.='<div class="row">
              <div class="col-xs-2">
                <div class="col-sm-12">
                  <span>&nbsp</span>
                </div>';
                foreach($requisicion->solicitudcotizacion as $soli):
                $lasoli.='<button data-id="'.$soli->id.'" id="lasolicitud" class="btn btn-primary col-sm-12">'.$soli->numero_solicitud.'</button>';
                  $lasoli.='<div class="clearfix"></div>
                  <hr style="margin-top: 3px; margin-bottom: 3px;">';
                endforeach;
              $lasoli.='</div>
              <div class="col-xs-9" id="aquilasoli">
                <h1 class="text-center">Seleccione una solicitud para mostrar la información</h1>
              </div>
            </div>';
          else: 
            if($requisicion->estado==1):
              $lasoli.='<center>
                  <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                  <span>La requisición no ha sido aprobada</span><br>
                </center>';
            elseif($requisicion->estado==2):
              $lasoli.='<center>
                  <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                  <span>La requisición fue rechazada</span><br>
                </center>';
            elseif($requisicion->estado==9):
              $lasoli.='<center>
                  <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                  <span>La requisición fue consolidada</span><br>
                </center>';
            else:
              $lasoli.='<center>
                  <h4 class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i> Advertencia</h4>
                  <span>Registre la solicitud</span><br><br>
                  <button class="btn btn-success" data-id="'.$requisicion->id.'" id="registrar_solicitud">Agregar</button>
                </center>';
            endif;
          endif;
          $lasoli.='</div>';
      return array(1,$html,$tabla,$lasoli);
    }catch(Exception $e){

    }
  }

  public static function requisiciones_por_tipo($tipo)
  {
    switch($tipo){
      case 2:
      $requisiciones=Requisicione::where('estado',2)->whereYear('created_at',date('Y'))->orderBy('created_at','DESC')->get();
      break;
      case 9:
      $requisiciones=Requisicione::where('estado',9)->whereYear('created_at',date('Y'))->orderBy('created_at','DESC')->get();
      break;
      case 8:
      $requisiciones=Requisicione::where('estado',8)->whereYear('created_at',date('Y'))->orderBy('created_at','DESC')->get();
      break;
      default:
      $requisiciones=Requisicione::where('enviada',true)->whereNotIn('estado',[8,9,2])->whereYear('created_at',date('Y'))->orderBy('created_at','DESC')->get();
    }

    $html="";

    $html.='<table class="table table-striped table-bordered" id="latabla">
    <thead>
      <th width="3%">N°</th>
      <th width="10%">Código</th>
      <th>Actividad</th>
      <th>Unidad administrativa</th>
      <th>Fuente de financiamiento</th>
      <th>Responsable</th>
      <th>Justificación</th>
      <th>Estado</th>
      <th>Accion</th>
    </thead>
    <tbody>';

    foreach($requisiciones as $key => $requisicion):
      $html.='<tr>
      <td>'.($key+1).'';if($requisicion->estado==1):$html.=' <input type="checkbox" data-id="'.$requisicion->id.'" data-date="'.$requisicion->fecha_solicitud->format('Y-m-d').'" class="combinar" style="display: none;">';endif;$html.='</td>
      <td>'.$requisicion->codigo_requisicion.'</td>
      <td>'.$requisicion->actividad.'</td>
      <td>'. $requisicion->unidad->nombre_unidad.'</td>';
      if(isset($requisicion->cuenta_id)):
      $html.='<td>'.$requisicion->cuenta->nombre.'</td>';
      else:
      $html.='<td>Sin definir</td>';
      endif;
      $html.='<td>'.$requisicion->user->empleado->nombre.'</td>
      <td>'.$requisicion->justificacion.'</td>
      <td>'.Requisicione::estado_ver($requisicion->id).'</td>
      <td><a href="requisiciones/'.$requisicion->id.'" title="Ver" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span></a></td>
      </tr>';
    endforeach;
    $html.='</tbody></table>';

    return array(1,$html);
  
  }

  public static function requisiciones_por_anio($anio)
  {
    $html="";

    try{
      $requisiciones=Requisicione::whereYear('created_at',$anio)->orderBy('created_at','DESC')->get();

      $html.='<table class="table table-striped table-bordered" id="latabla">
    <thead>
      <th width="3%">N°</th>
      <th width="10%">Código</th>
      <th>Actividad</th>
      <th>Unidad administrativa</th>
      <th>Fuente de financiamiento</th>
      <th>Responsable</th>
      <th>Observaciones</th>
      <th>Estado</th>
      <th>Acción</th>
    </thead>
    <tbody>';

    foreach($requisiciones as $key => $requisicion):
      $html.='<tr>
      <td>'.($key+1).'</td>
      <td>'.$requisicion->codigo_requisicion.'</td>
      <td>'.$requisicion->actividad.'</td>
      <td>'. $requisicion->unidad->nombre_unidad.'</td>';
      if(isset($requisicion->cuenta_id)):
      $html.='<td>'.$requisicion->cuenta->nombre.'</td>';
      else:
      $html.='<td>Sin definir</td>';
      endif;
      $html.='<td>'.$requisicion->user->empleado->nombre.'</td>
      <td>'.$requisicion->observaciones.'</td>
      <td>'.Requisicione::estado_ver($requisicion->id).'</td>
      <td><a href="requisiciones/'.$requisicion->id.'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a></td>
      </tr>';
    endforeach;
    $html.='</tbody></table>';

    return array(1,$html);
    }catch(Exception $e){
      $html.='<table class="table table-striped table-bordered" id="latabla">
    <thead>
      <th width="3%">N°</th>
      <th width="10%">Código</th>
      <th>Actividad</th>
      <th>Unidad administrativa</th>
      <th>Fuente de financiamiento</th>
      <th>Responsable</th>
      <th>Observaciones</th>
      <th>Estado</th>
      <th>Acción</th>
    </thead>
    <tbody></tbody></table>';
    return array(-1,$html);
    }
  
  }

  public static function modal_agregarproducto($data)
  {
    $material=Materiales::find($data['material']);
    $disponible=$data['disponible'];
    $modal="";
    $modal.='<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_registrar_material" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Registrar el material</h4>
        </div>
        <div class="modal-body">
          <form id="form_material">
            <div class="form-group">
              <label for="" class="control-label">Material a agregar: '.$material->nombre.'</label>
            </div>

            <div class="form-group">
              <label class="control-label">Cantidad disponible</label>
              <div>
                <input class="form-control" type="text" value="'.$disponible.'" name="disponible" readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="control-label">Digite la cantidad a agregar</label>
              <div>
                <input type="text" class="form-control" name="cantidad" >
                <input type="hidden" class="form-control" name="requisicion_id" value="'.$data['elid'].'">
                <input type="hidden" class="form-control" name="unidad_medida" value="'.$data['unidad_medida'].'">
                <input type="hidden" class="form-control" name="materiale_id" value="'.$material->id.'">
              </div>
            </div>
                      
          </form>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" id="registrar_mate" class="btn btn-success">Agregar</button></center>
        </div>
      </div>
      </div>
    </div>';
    return array(1,"exito",$modal);
  }
}
