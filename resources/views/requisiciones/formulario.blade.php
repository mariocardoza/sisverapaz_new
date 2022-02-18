@php
    $unids=App\Unidad::where('estado',1)->get();
@endphp
<div class="form-group">
  <label for="" class="control-label">Actividad</label>
  <div class="">
    {!! Form::textarea('actividad',null,['class' => 'form-control','placeholder'=>'Digite la actividad a realizar','rows'=>3]) !!}
  
  </div>
</div>

<div class="form-group">
  <label for="" class="control-label">Unidad Solicitante</label>
  <div class="">
    {!!Form::text('',Auth()->user()->unidad->nombre_unidad,['class' => 'form-control','readonly'])!!}
    {!!Form::hidden('unidad_id',Auth()->user()->unidad_id,['class' => 'form-control','readonly'])!!}
  </div>
</div>

  <div class="form-group">
    <label for="" class="control-label">Responsable</label>
      <div class="">
        
        {{Form::hidden('user_id',Auth()->user()->id)}}
        {!!Form::text('',Auth()->user()->empleado->nombre,['class' => 'form-control','readonly'])!!}
      </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Fecha actividad</label>
    <div class>
      @isset($requisicion)
      {{Form::text('fecha_solicitud',$requisicion->fecha_solicitud->format('d-m-Y'),['class'=>'form-control','autocomplete'=>'off','id'=>'fecha_solicitud'])}}
      @else
      {{Form::text('fecha_solicitud',null,['class'=>'form-control','autocomplete'=>'off','id'=>'fecha_solicitud'])}}
      @endif

    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Justificación</label>
      <div class="">
        {!!Form::textarea('justificacion',null,['placeholder'=>'Ingrese la justificación','class' => 'form-control','rows' => 3])!!}
      </div>
  </div>
