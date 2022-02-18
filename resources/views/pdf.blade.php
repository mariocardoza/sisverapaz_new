@extends('layouts.app')

@section('content')
<div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="example2">
  				      <thead>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Nombre de Usuario</th>
                  <th>Correo</th>
                  <th>Cargo</th>
                </thead>
                <tbody>
                	@foreach($usuarios as $user)
                	<tr>
                		<td>{{ $user->id }}</td>
                		<td>{{ usuario($user->empleado_id) }}</td>
                		<td>{{ $user->username }}</td>
                		<td>{{ $user->email }}</td>
                    <td>{{ vercargo($user->cargo) }}</td>
                	</tr>
                	@endforeach
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
@endsection
