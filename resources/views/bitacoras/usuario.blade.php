<?php 
use App\Bitacora;
use Carbon\Carbon; ?>
@extends('layouts.app')

@section('migasdepan')
<h1>
        Bitacora
        <small>Control de bitacora</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/bitacoras') }}"><i class="fa fa-dashboard"></i> Bitacoras</a></li>
        <li class="active">Listado de bitacoras</li>
      </ol>
@endsection

@section('content')
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" >
              <table class="table table-hover">
  				<thead>
                  <th>Id</th>
                  <th>Fecha de actividad</th>
                  <th>Hora de la actividad</th>
                  <th>Accion</th>
                  <th>Usuario</th>
                  <th>Opción</th>
                </thead>
                <tbody>
                	@foreach($bitacoras as $bitacora)
                	<tr>
                		<td>{{ $bitacora->id }}</td>
                    <td>{{ $bitacora->registro->format('d-m-Y') }}</td>
                		<td>{{ $bitacora->hora }}</td>
                		<td>{{ $bitacora->accion }}</td>
                    <?php 
                     $nombre= Bitacora::vernombre($bitacora->idusuario);
                    ?>
                    <td>{{ $nombre }}</td>
                		<td>
                    <a href="{{ url('bitacora/'.$bitacora->id) }}" class="btn btn-primary">Ver</a>
                      
                      {{-- {!! link_to_route('proveedores.destroy', 'ELiminar', [$proveedor->id]) !!}
                			<a class="btn btn-primary" href ="{{ route('proveedores.destroy', $proveedor->id) }}" role="button" >Eliminar </a> --}}
                    </td>
                	</tr>
                	@endforeach 
                </tbody>
              </table>
                <div class="pull-right">
                 {{ $bitacoras->links() }} 
                 </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
@endsection
