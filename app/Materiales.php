<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Materiales extends Model
{
	protected $table="materiales";
    public $incrementing = false;
    protected $guarded=[];

    public function unidadmedida(){
    	return $this->belongsTo('App\UnidadMedida','unidad_id')->withDefault();
    }

    public function categoria(){
    	return $this->belongsTo('App\Categoria');
    }

    public static function mas_utilizados()
    {
        $bienes= DB::table('detallecotizacions as dc')
        ->select('m.nombre as bien',DB::raw('sum(dc.cantidad) as cuantos'))
        ->join('cotizacions as c','c.id','=','dc.cotizacion_id','inner')
        ->join('materiales as m','m.id','=','dc.material_id','inner')
        ->where('c.seleccionado',1)
        ->whereYear('c.created_at',date("Y"))
        ->groupby('dc.material_id','m.nombre')
        ->orderBy('cuantos','ASC')
        ->take(10)
        ->get();
        return $bienes;
    }

    public static function modal_editar($id)
    {
        $modal="";
        try{
            $material=Materiales::find($id);
            $categorias=Categoria::where('estado',1)->get();
            //$medidas=unidadmedida::get();
            $modal.='<div class="modal fade" tabindex="-1" id="md_material_edit" role="dialog" aria-labelledby="gridSystemModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="gridSystemModalLabel">Editar Bien o Insumo</h4>
                </div>
                <div class="modal-body">
                  <form id="form_ematerial" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nombre" value="'.$material->nombre.'">
                                </div>       
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Precio estimado</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="precio_estimado" value="'.$material->precio_estimado.'">
                                </div>       
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="control-label col-md-4">¿Es un servicio?</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="servicio">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="button" id="editar_material" data-id="'.$material->id.'" class="btn btn-success">Editar</button></center>
                </div>
              </div>
            </div>
          </div>';

            return array(1,"exito",$modal);
        }catch(Exception $e){

        }
    }
}
