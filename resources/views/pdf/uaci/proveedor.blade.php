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
          <th>Dirección</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Representante</th>
          <?php $correlativo=0?>
        </tr>  
      </thead>
      <tbody>
        @foreach($proveedores as $proveedor)
        <tr>
          <?php $correlativo++?>
          <td>{{ $correlativo }}</td>
          <td>{{ $proveedor->nombre }}</td>
          <td>{{ $proveedor->direccion }}</td>
          <td>{{ $proveedor->email }}</td>
          <td>{{ $proveedor->telefono }}</td>
          <td>{{ $proveedor->nombrer }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
