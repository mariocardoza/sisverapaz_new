@extends('pdf.plantilla')
@section('reporte')
  <div id="header">
    
    <table rules="" width="100%">
      <tr>
        <td width="15%" rowspan="2"><center><img src="{{asset('img/escudoes.gif')}}" width="100px" height="100px" alt=""></center></td>
        <td width="70%"><h1><center>Alcaldia municipal de Verapaz</center></h1></td>
        <td width="15%" rowspan="2"><center><img src="{{asset('img/escudoes.gif')}}" width="100px" height="100px" alt="escudo El Salvador"></center></td>
      </tr>
      <tr>
        <td><center>{{$unidad}}</center></td>
      </tr>
    </table>
  </div>
  <div id="footer">
    <table width="100%">
      <tr>
        <td><center>Final av. crecencio miranda</center></td>
      </tr>
      <tr>
        <td><center class="page"> Página </center></td>
      </tr>
    </table>
  </div>
  <div id="content">
    <table class="table table-hover" width="100%" rules=all>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Nombre de Usuario</th>
          <th>Correo</th>
          <th>Cargo</th>
        </tr>  
      </thead>
      <tbody>
        @foreach($usuarios as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->nombre }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ vercargo($user->cargo) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
