<div class="form-group">
    <label for="" class="col-md-4">Descripción</label>
    <div class="col-md-6">
      {{Form::text('',$detalle->catalogo->nombre,['class' => 'form-control','readonly'])}}
    </div>
</div>
<div class="form-group">
    <label for="" class="col-md-4">Digite la cantidad que necesita</label>
    <div class="col-md-6">
        {{Form::number('cantidad',null,['class' => 'form-control','min'=>'1','steps'=>'1'])}}
    </div>
</div>
<div class="form-group">
    <label for="" class="col-md-4">Digite el precio unitario</label>
    <div class="col-md-6">
        {{Form::number('preciou',null,['class' => 'form-control','step' => '.01','min'=>'.01','required'])}}
    </div>
</div>
