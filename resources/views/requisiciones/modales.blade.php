@php
    $lacuentas=\App\Cuenta::where('estado',1)->get();
    $cuentas=[];
    foreach($lacuentas as $item){
      $cuentas[$item->id]=$item->nombre;
    }
@endphp

<div class="modal fade" tabindex="-1" id="modal_ayuda" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Ayuda</h4>
      </div>
      <div class="modal-body">
      <p>
        Esta sección es para administrar la informacion de las requisiones, cambiar las cantidades de los insumos o agregar adicionales; siempre y cuando aun no haya enviado la requisición a uaci
      </p>
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button></center>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Agregar bienes o servicios a la requisición</h4>
    </div>
    <div class="modal-body">
      <form id="form_detalle">
        <input type="hidden" name="requisicion_id" class="elid" value="{{$requisicion->id}}">
        
        <div class="form-group">
          <label for="">Bien o servicio</label>
          <input type="text" list="material" class="form-control" name="nombre" autocomplete="off">
          <datalist id="material">
            @foreach($materiales as $m)
                <option value="{{$m->nombre}}">
            @endforeach
          </datalist>
        </div>
        <div class="form-group">
          <label for="">Unidad de medida</label>
          <input type="text" class="form-control" name="unidad_medida">
        </div>

        <div class="form-group">
          <label for="cantidad">Cantidad</label>
          <input type="number" step="any" class="form-control" name="cantidad" autocomplete="off">
        </div>
        <div class="form-group">
          <center>
            <button class="btn btn-danger" data-dismiss="modal" aria-label="Close" type="button">Cancelar</button>
            <button class="btn btn-success" type="submit">Guardar</button>
          </center>
        </div>
      </form>
    </div>
    <!--div class="modal-footer">
      <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="button" id="agregar_otro" class="btn btn-success">Agregar</button></center>
    </div-->
  </div>
  </div>
</div>


<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_detalle_sin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar insumo</h4>
      </div>
      <div class="modal-body">
        <form id="form_detalle_sin" class="">
          <input type="hidden" name="requisicion_id" class="elid" value="{{$requisicion->id}}">
          <div class="form-group">
            <label for="" class="control-label">Bienes o servicios</label>
            <div>
              <select name="" id="sel_mate_sin" class="chosen-select-width">
                <option value="">Seleccione un bien o servicio</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="control-label">Digite la cantidad</label>
            <div>
              <input type="number" id="cantiti" class="form-control">
            </div>
          </div>

         

          <div class="form-group">
              <button class="btn btn-success" type="button" id="registrar_mate_sin">Guardar</button>
          </div>
          


          
        </form>
      </div>
      <!--div class="modal-footer">
        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="agregar_otro" class="btn btn-success">Agregar</button></center>
      </div-->
    </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_registrar_soli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Registrar la solicitud</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(['class' => 'form-horizontal','id' => 'solicitudcotizacion']) }}
          

                  
      {{Form::close()}}
    </div>
    <div class="modal-footer">
      <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      <button type="button" id="agregar_soli" class="btn btn-success">Guardar</button></center>
    </div>
  </div>
  </div>
</div>


<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_finalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir acta de cierre</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['action'=>'RequisicionController@subir', 'class' => '','id' => 'form_subiracta','enctype'=>'multipart/form-data']) }}
            <input type="hidden" name="requisicion_id" value="{{$requisicion->id}}">
            <label for="file-upload2" class="subir">
              <i class="glyphicon glyphicon-cloud"></i> Subir archivo
          </label>
          <input id="file-upload2" onchange='cambiar2()' name="archivo" type="file" style='display: none;'/>
          <div id="info4"></div>
              <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit"  class="btn btn-success">Guardar</button></center>
        {{Form::close()}}
      </div>
      <!--div class="modal-footer">
        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="agregar_orden" class="btn btn-success">Agregar</button></center>
      </div-->
    </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_subir_contrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir contrato</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['action'=>'RequisicionController@subircontrato', 'class' => '','id' => 'form_subircontrato','enctype'=>'multipart/form-data']) }}
            <input type="hidden" name="requisicion_id" value="{{$requisicion->id}}">
            <div class="form-group">
              <label for="" class="control-label">Nombre</label>
              <div>
                <input type="text" class="form-control" name="nombre" autocomplete="off" placeholder="Nombre del contrato">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label">Descripción</label>
              <div>
                <input type="text" class="form-control" name="descripcion" autocomplete="off" placeholder="Nombre del contrato">
              </div>
            </div>
            <label for="file-upload" class="subir">
              <i class="glyphicon glyphicon-cloud"></i> Subir archivo
          </label>
          <input id="file-upload" onchange='cambiar()' name="archivo" type="file" style='display: none;'/>
          <div id="info3"></div>
              <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit"  class="btn btn-success">Guardar</button></center>
        {{Form::close()}}
      </div>
      <!--div class="modal-footer">
        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="agregar_orden" class="btn btn-success">Agregar</button></center>
      </div-->
    </div>
    </div>
</div>

  <!-- Modal -->

  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_aprobar_requisicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-sm">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Aprobar requisición</h4>
        </div>
        <div class="modal-body">
          {{ Form::open(['action'=>'RequisicionController@aprobar', 'class' => '','id' => 'form_aprobarrequi','enctype'=>'multipart/form-data']) }}
              <input type="hidden" name="requisicion_id" value="{{$requisicion->id}}">
              <label for="" class="control-label">Para aprobar la requisición debe seleccionar una fuente de financiamiento</label>
              <div class="form-group">
                <label for="" class="control-label"></label>
                <div>
                  {!! Form::select('cuenta_id',$cuentas,null,['class'=>'chosen-select-width cuenta_elid','placeholder'=>'seleccione la fuente e financiamiento','required'=>'']) !!}
                </div>
              </div>
          
          {{Form::close()}}
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" id="aprobar_requisicion" class="btn btn-success">Aprobar</button></center>
        </div>
      </div>
      </div>
  </div>

  
  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_darbaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="nom_material">Eliminar requisición</h4>
        </div>
        <div class="modal-body">
          {{ Form::open(['class' => '','id' => 'form_darbaja']) }}
              
            <div class="form-group">
                <label for="" class="control-label">Motivo</label>
                <div class="">
                    <input type="text" autocomplete="off" placeholder="Digite el motivo para eliminar"  required name="motivo_baja" value="" class="form-control">

                <input type="hidden" name="requisicion_id" value="{{$requisicion->id}}" class="form-control">

            </div>
            </div>
                      
          {{Form::close()}}
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" id="dar_baja" class="btn btn-success">Guardar</button></center>
        </div>
      </div>
      </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_formaPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="">Registrar nueva forma de pago</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['class' => '','id' => 'form_formapago']) }}
            
          <div class="form-group">
              <label for="" class="control-label">Nombre</label>
              <div class="">
                <input type="text" autocomplete="off" placeholder="Digite nueva forma de pago"  required name="nombre" value="" class="form-control">
              </div>
          </div>
                    
        
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button></center>
      </div>
      {{Form::close()}}
    </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_confirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de autorización de la requisición</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['class' => '','id' => 'form_confirmacion']) }}
        <input type="hidden" name="requisicion_id" value="{{$requisicion->id}}">
        <input type="hidden" name="cuenta_id" id="lacuentaid" value="">
        <div class="form-group">
          <label for="" class="control-label">Digite el nombre de usuario</label>
            <div class="">
              <input type="text" id="el_usernamee" name="username" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label">
                Contraseña
            </label>
            <div>
                  <input type="password" id="el_passworde" name="password" class="form-control">
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Confirmar</button></center>
      </div>
      {{Form::close()}}
    </div>
    </div>
</div>

