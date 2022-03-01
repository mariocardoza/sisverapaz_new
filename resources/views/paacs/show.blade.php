@extends('layouts.app') 
@section('content')
<div class="conteiner">
<div class="row">
  <div class="col-md-12" id="elplan" style="display: block;"></div>
  <div class="col-md-12" id="panel_registrar" style="display: none;">
    <div class="card">
      <div class="panel-heading">Registrar</div>
      <div class="panel">
        <form id="form_paac" class="">
          <br />

          <input type="hidden" name="paac_id" value="{{$paac->id}}" />
          @include('paacs.formulario')
          <div class="form-group">
            <center>
              <button type="button" id="guardar" class="btn btn-success">
                Guardar
              </button>
              <button class="btn btn-danger" id="cancelar_guardar" type="button">
                Cancelar
              </button>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-12" id="panel_editar" style="display: none;">
    <div class="panel panel-primary">
      <div class="panel-heading">Editar</div>
      <div class="panel" id="form_aqui"></div>
    </div>
  </div>
</div>
</div>
@endsection 
@section('scripts')
<script>
  var idpaac = "<?php echo $paac->id ?>";
  var eltitulo = "<?php echo $paac->paaccategoria->nombre ?>";
  var anioplan = "<?php echo $paac->anio ?>";
</script>
{!! Html::script('js/paac.js?cod='.date('Yidisus')) !!} @endsection
