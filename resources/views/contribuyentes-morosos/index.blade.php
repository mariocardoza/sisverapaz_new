@extends('layouts.app')

@section('migasdepan')
<h1>
        Contribuyentes Morosos
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Listado de Contribuyentes</li>
      </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <br>
            <div class="box-heading">
                <h3></h3>
                <div class="btn-group pull-right">
                    <a href="{{ url('contribuyentes-morosos?type=1') }}" class="btn btn-primary" title="Ver por Inmuebles">Inmuebles</a>
                    <a href="{{ url('contribuyentes-morosos?type=2') }}" class="btn btn-primary" title="Ver por Negocios">Negocios</a>
               
                </div>
                <br><br>
            </div>
            <div class="box-body">
                <table class="table" id="example2">
                    <thead>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>NIT</th>
                        <th>Detalle</th>
                        <th>Periodo</th>
                        <th>Deuda</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($coleccion  as $i => $c)
                        @if(!is_null($c))
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$c['contribuyente']}}</td>
                            <td>{{$c['direccion']}}</td>
                            <td>{{$c['nit']}}</td>
                            <td>{{$c['detalle']}}</td>
                            <td>{{$c['periodo']}}</td>
                            <td>${{number_format($c['deuda'],2)}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{url('contribuyentes/pagos/'.$c['id'])}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection