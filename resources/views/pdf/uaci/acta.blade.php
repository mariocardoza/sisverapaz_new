@extends('pdf.plantilla')
@include('pdf.uaci.cabecera')
@include('pdf.uaci.pie')
@section('reporte')
<div>
  <div class="row">
      <br>
      <p style="font-size:14">Reunidos en: la <em> Alcaldía municipal de Verapaz, departamento de San Vicente;</em><b> a las: 
        @if($orden->cotizacion->solicitudcotizacion->tipo==1) 
        {{$orden->cotizacion->solicitudcotizacion->proyecto->fecha_acta->format('H:i a')}}
      del día: {{fechaCastellano($orden->cotizacion->solicitudcotizacion->proyecto->fecha_acta)}}</b></p>
      <p style="font-size:14"> Los señores: <b>{{$orden->cotizacion->proveedor->nombre}}</b> Ofertante y <b>{{Auth()->user()->empleado->nombre}}</b> Jefe de la unidad de adquisiciones y contrataciones institucionales.</p>
      @elseif($orden->cotizacion->solicitudcotizacion->tipo==2) 
      {{$orden->cotizacion->solicitudcotizacion->requisicion->fecha_acta->format('H:i a')}}
        del día: {{fechaCastellano($orden->cotizacion->solicitudcotizacion->requisicion->fecha_acta)}} .<p>
            <p style="font-size:14"> Los señores: <b>{{$orden->cotizacion->proveedor->nombre}}</b> Ofertante y <b>{{$orden->cotizacion->solicitudcotizacion->requisicion->user->empleado->nombre}}</b> Jefe de la {{$orden->cotizacion->solicitudcotizacion->requisicion->unidad->nombre_unidad}}.</p>
      @else
      {{$orden->cotizacion->solicitudcotizacion->solirequi->fecha_acta->format('H:i a')}}
        del día: {{fechaCastellano($orden->cotizacion->solicitudcotizacion->solirequi->fecha_acta)}} .<p>
            <p style="font-size:14"> Los señores: <b>{{$orden->cotizacion->proveedor->nombre}}</b> Ofertante y <b>{{$orden->adminorden}}</b> Jefe de la Unidad de Adquisiciones y Contrataciones Institucional .</p>
            
      @endif
          <p style="font-size:14">A efecto de constatar que lo que acontinuación de detalla, se entrega y recibe de acuerdo a lo establecido en la Orden de compra correspondiente:</p>
          <p style="font-size:14">
            <table class="table table-bordered"><thead>
              <tr>
                <th>Nombre</th>
                <th>Unidad de medida</th>
                <th>Cantidad</th>
              </tr>
          @foreach ($orden->cotizacion->solicitudcotizacion->detalle as $detalle)
              {{-- <b>{{$detalle->material->nombre}}@if(!$loop->last),@else. @endif</b> --}}
              <tr>
              <th>{{$detalle->material->nombre}}</th>
              <th>{{$detalle->unidad_medida}}</th>
              <th>{{$detalle->cantidad}}</th>
              </tr>
              
          @endforeach
            </thead></table>
          </p>
          <p style="font-size:14">Dándonos por satisfechos ambas partes. Y en fe de lo cual firmamos la presente.</p>
          <br>
          <p><b>Entrega:</b></p>
          <p>Firma  __________________________________</p>
          <p>Nombre __________________________________</p>
          <br><br>
          <p class="text-right"><b>Recibí conforme:</b></p>
          <p class="text-right">Firma  ___________________</p>
          @if($orden->cotizacion->solicitudcotizacion->tipo==1)
          <p class="text-right">{{Auth()->user()->empleado->nombre}}</p>
          @elseif($orden->cotizacion->solicitudcotizacion->tipo==2)
        <p class="text-right">{{$orden->cotizacion->solicitudcotizacion->requisicion->user->empleado->nombre}}</p>
        @else
        <p class="text-right">{{$orden->cotizacion->solicitudcotizacion->encargado}}</p>
          @endif
  </div>
</div>
@endsection

