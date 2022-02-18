@extends('pdf.plantilla') 
@include('pdf.uaci.cabecera') 
@section('titulo')
{{ $tipo }}
@endsection 
@section('reporte')
<div id="content">
  <table width="100%" rules="">
    <tbody>
      <tr>
        <td>
          <p>
            <b>UNIDAD SOLICITANTE:</b> {{$requisicion->unidad->nombre_unidad}}
          </p>
          <p><b>RESPONSABLE:</b> {{$requisicion->user->empleado->nombre}}</p>
          <p><b>ACTIVIDAD:</b> {{$requisicion->actividad}}</p>
        </td>
        <td>
          <p><b>FECHA SOLICITUD:</b> {{ fechaCastellano($requisicion->fecha_solicitud) }}</p>
          <p><b>FIRMA:</b> ___________________________</p>
        </td>
      </tr>
    </tbody>
  </table>
  @if($requisicion->estado==2)
  <img src="{{ public_path("img/anulado.png") }}" style="position: absolute" alt=""> @endif
  <br /><br />
  <p></p>
  <table width="100%" border="1" class="table" rules="all">
    <thead>
      <tr style="background-color:#BCE4F3;">
        <th width="5%">N° ITEM</th>
        <th width="8%">CANTIDAD SOLICITADA</th>
        <th width="50%%"><center>DESCRIPCIÓN</center></th>
        <th width="15%">U/MEDIDA</th>
        @php $correlativo = 0; $total = 0.0; @endphp
      </tr>
    </thead>
    <tbody>
      @foreach($requisicion->requisiciondetalle as $index => $detalle)
      <tr>
        <td>
          {{ $index + 1 }}
        </td>
        <td>
          {{$detalle->cantidad}}
        </td>
        <td>
          {{$detalle->material->nombre}}
        </td>
        <td>
          {{$detalle->unidad_medida}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <p></p>
  <p>JUSTIFICACIÓN: {{$requisicion->justificacion}}</p>

  <p>OBSERVACIONES: {{$requisicion->observaciones}}</p>

  <p></p>

  <table width="100%" cellspacing="30px">
    <tr>
      <td>
        AUTORIZA:
      </td>
      <td>
        RECIBE:
      </td>
    </tr>
    <tr>
      <td>
        F.____________________<br />
        <p></p>
        ALCALDE MUNICIPAL
      </td>
      <td>
        F.____________________<br />
        <p></p>
        JEFE DE UACI
      </td>
    </tr>
  </table>
</div>
@endsection 
@include('pdf.uaci.pie')
