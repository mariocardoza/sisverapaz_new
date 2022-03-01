@extends('layouts.app')

@section('migasdepan')
      <h1>
       Ordenes de Compra
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/ordencompras') }}"><i class="fa fa-dashboard"></i> Ordenes de compra</a></li>
        <li class="active">Listado de ordenes</li>
      </ol>
@endsection

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="box">
    <p></p>
    <div class="box-header">
      <br>
      {{--<div class="btn-group pull-right">
        <a href="{{ url('ordencompras?estado=1') }}" class="btn btn-danger" title="Ordenes de compra pendientes de pago">Pendientes</a>
        <a href="{{ url('ordencompras?estado=3') }}" class="btn btn-primary" title="Ordenes de compra pagadas">Pagadas</a>
      </div>--}}
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table class="table table-striped table-bordered table-hover" id="example2">
        <thead>
          <th><center>N°</center></th>
          <th><center>Correlativo orden</center></th>
          <th><center>Monto a pagar</center></th>
          <th><center>Proveedor</center></th>
          <th><center>Nombre de la actividad</center></th>
          <th><center>Financiamiento</center></th>
          <th><center>Acciones</center></th>
          <?php $contador=0 ?>
        </thead>
        <tbody>
          @foreach($ordenes as $orden)
            <tr>
              @php
                $contador++;
              @endphp
              <td>{{$contador}}</td>
              @if($orden->tipo==1)
              <td>{{$orden->numero_orden}}</td>
              <td class="text-right">${{number_format(App\Detallecotizacion::total_cotizacion($orden->cotizacion->id),2)}}</td>
              <td>{{$orden->cotizacion->proveedor->nombre}}</td>
                
                @if($orden->cotizacion->solicitudcotizacion->tipo==2)
                  <td>{{$orden->cotizacion->solicitudcotizacion->requisicion->actividad}}</td>
                  <td>{{$orden->cotizacion->solicitudcotizacion->requisicion->cuenta->nombre}}</td>
                @else 
                <td>
                @foreach ($orden->cotizacion->solicitudcotizacion->solirequi->requisiciones as $index => $item)
                <b>Actividad N°: {{$index+1}}</b> {{$item->actividad}},
                @endforeach
              </td>
              <td>{{$orden->cotizacion->solicitudcotizacion->solirequi->cuenta->nombre}}</td>
              <td><div class="btn-group">
                <a href="{{ url('reportesuaci/ordencompra/'.$orden->id) }}" class="btn btn-primary vista_previa" target="_blank" title="Imprimir orden de compra"><i class="fa fa-print"></i></a>
              </div>
              </td>
                @endif
                <td>
                <div class="btn-group">
                  <a href="{{ url('reportesuaci/ordencompra/'.$orden->id) }}" class="btn btn-primary vista_previa" target="_blank" title="Imprimir orden de compra"><i class="fa fa-print"></i></a>
                </div>
                </td>
      {{-- AQUI TERMINAN LAS FUNCIONES DE BOTONES PARA ORDENES POR PROCESOS DE COTIZACION --}}

              @else 
      {{-- AQUI VA LAS FUNCIONES DE BOTONES PARA ORDENES POR COMPRA DIRECTAS --}}
              <td>{{$orden->numero_orden}}</td>
              <td class="text-right">${{number_format($orden->compradirecta->monto,2)}}</td>
              <td>{{$orden->compradirecta->proveedor->nombre}}</td>
              <td>{{$orden->compradirecta->nombre}}</td>
              <td>{{$orden->compradirecta->cuenta->nombre}}</td>
              @if($orden->estado==1)
                  <td>Pendiente de acta de recibido</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ url('reportesuaci/ordencompra2/'.$orden->id) }}" class="btn btn-primary vista_previa" target="_blank" title="Imprimir orden de compra"><i class="fa fa-print"></i></a>
                      <a href="javascript:void(0)" data-id="{{$orden->id}}" data-compra="{{$orden->compradirecta->id}}" class="btn btn-danger" title="Anular orden de compra"><i class="fa fa-remove"></i></a>
                    </div>
                  </td>
                @elseif ($orden->estado==2)
                  <td>Anulada</td>
                  <td></td>
                @elseif($orden->estado==3)
                  <td>Pago pendiente</td>
                  <td>
                    <a class="btn btn-primary vista_previa" title="Ver" href="{{url('reportesuaci/ordencompra2/'.$orden->id)}}"><span class="fa fa-eye"></span></a>
                  </td>
                @else 
                <td>Pagado</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ url('reportesuaci/ordencompra/'.$orden->id) }}" class="btn btn-primary vista_previa" target="_blank" title="Imprimir orden de compra"><i class="fa fa-print"></i></a>
                  </div>
                </td>
                @endif
              @endif
             
            
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    //anular la orden
    $(document).on("click",".quitar_o",function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var tipo=$(this).attr("data-tipo");
      var coti=$(this).attr("data-coti");
      swal({
        title: '¿Porqué elimina la orden de compra?',
        input: 'text',
        showCancelButton: true,
        confirmButtonText: 'Dar de baja',
        showLoaderOnConfirm: true,
        preConfirm: (text) => {
          return new Promise((resolve) => {
            setTimeout(() => {
              if (text === '') {
                swal.showValidationError(
                  'El motivo es requerido.'
                )
              }
              resolve()
            }, 2000)
          })
        },
        allowOutsideClick: () => !swal.isLoading()
      }).then((result) => {
        if (result.value) {
          var motivo=result.value;
          $.ajax({
            url:'ordencompras/'+id,
            type:'delete',
            dataType:'json',
            data:{tipo,coti,motivo},
            success:function(json){

            },
            error: function(error){

            }
          });
        }
      });
      
    });
  });
</script>
@endsection
