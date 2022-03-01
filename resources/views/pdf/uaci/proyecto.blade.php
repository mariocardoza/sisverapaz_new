@extends('pdf.plantilla')
@section('reporte')
@include('pdf.uaci.cabecera')
@include('pdf.uaci.pie')
  <div id="content">
    <table class="table table-hover" width="100%" rules=all>
      <thead>
        <tr>
          <th>N°</th>
          <th>Nombre</th>
          <th>Monto</th>
          <th>Dirección</th>
          <th>Inicio</th>
          <th>Fin</th>
        </tr>  
      </thead>
      <tbody>
        @foreach($proyectos as $proyecto)
        <tr>
          <td>{{ $proyecto->id }}</td>
          <td>{{ $proyecto->nombre }}</td>
          <td>{{ $proyecto->monto }}</td>
          <td>{{ $proyecto->direccion }}</td>
          <td>{{ $proyecto->fecha_inicio }}</td>
          <td>{{ $proyecto->fecha_fin }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
