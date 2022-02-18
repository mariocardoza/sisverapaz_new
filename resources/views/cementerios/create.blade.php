@extends('layouts.app') 
@section('migasdepan')
<h1>
        Cementerios
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="{{ url('/cementerios') }}"><i class="fa fa-home"></i> Cementerio</a></li>
        <li class="active">Crear</li>
      </ol>
@endsection
@section('content')
<div style="width: 100%;">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cementerio</h3>
        </div>
        <form action="#" id="formulario" name="formulario">
          <div class="box-body">
            <div style="height: 500px;" class="form-group">
              {!! $map['html'] !!}
            </div>
            <div class="form-group col-sm-5">
              <label for="nombre">Nombre del cementerio: </label>
              @if ($isDrawing)
                <input
                  type="text"
                  class="form-control"
                  id="nombre" autocomplete="off" name="nombre"
                  placeholder="Nombre del cementerio"
                />
              @else
                <h2>{{ $cementerio->nombre }}</h2> 
              @endif
            </div>
            <div class="form-group col-sm-4">
              <label for="cantidad">Cantidad de puestos de perpetuidad</label>
              @if ($isDrawing)
                <input
                  type="number"
                  class="form-control"
                  id="cantidad" min='100' name="cantidad"
                  placeholder="Cantidad Maxima de puestos de perpetuidad"
                />
              @else
                <h2>{{ $cementerio->maximo }}</h2>                  
              @endif
            </div>
            <div class="form-group col-sm-1">
              @if ($isDrawing)
                <button
                  type="submit"
                  style="position: absolute; top: 20px;"
                  class="btn btn-success">
                  Guardar
                </button>                  
              @endif
            </div>
            <div class="form-group col-sm-1">
              @if ($isDrawing)
                <a
                  href="{{url('cementerios')}}"
                  style="position: absolute; top: 20px;"
                  class="btn btn-danger">
                  Atras
                </a>                  
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{!! $map['js'] !!} 
@endsection 
@section('scripts') 
<style>
.swal2-icon::before {
  font-size: 1.75em !important;
}
.swal2-icon {
    width: 100px !important;
    height: 100px !important;
}
.swal2-popup {
  width: 500px !important;
  padding: 2.5em;
  font-size: 1.1rem;
}
</style>
@if ($isDrawing)
  <script src="{{ asset('js/cementerios.js') }}"></script>    
@endif
@endsection