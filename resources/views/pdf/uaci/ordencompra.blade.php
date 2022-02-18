@extends('pdf.plantilla')
@include('pdf.uaci.cabecera')
@include('pdf.uaci.pie')
@section('reporte')
 <div id="content" class="">
    <div class="row">
        <div class="col-md-11">
            <div class="">
                <div class="panel-body">
                    <table width="100%" border="" class="table table-bordered">
                      <colgroup></colgroup>
                      <colgroup></colgroup>
                      <tbody>

                        <tr>
                          <td>SEÑORES: <b>{{$ordencompra->cotizacion->proveedor->nombre}}</b>
                            <p></p> NIT N°: <b>{{$ordencompra->cotizacion->proveedor->nit}}</b>
                            <p></p> DUI N°: <b>{{$ordencompra->cotizacion->proveedor->dui}}</b>
                            <p></p> TELÉFONO: <b>{{$ordencompra->cotizacion->proveedor->telefono}}</b>
                          </td>
                          <td>ORDEN N°: <b>{{$ordencompra->numero_orden}}</b>
                            <p></p>
                            <p></p> FECHA DE EMISIÓN: <b>{{fechaCastellano($ordencompra->created_at)}}</b>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                    <p></p>
                    Solicito a ustedes por favor entregar a la mayor brevedad posible y en días hábiles, después de haber recibido la Orden de Compra.
                    <br>
                    <!--div class="table-responsive"-->
                      <table width="100%" cellspacing="10px" class="table table-striped table-bordered" >
                        <thead>
                          <tr>
                            <th width="5%">N°</th>
                            <th width="45%">DESCRIPCIÓN</th>
                            <th width="15%">U/ DE MEDIDA</th>
                            <th width="10%">CANT.</th>
                            <th width="10%">P/ UNIT.</th>
                            <th width="15%">SUBTOTAL</th>
                            @php
                              $correlativo=0;
                              $total=0.0;
                              $renta=0.0;
                            @endphp
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($ordencompra->cotizacion->detallecotizacion as $detalle)
                            <tr>
                              @php
                                $correlativo++;
                                $total=$total+$detalle->precio_unitario*$detalle->cantidad;
                                if($detalle->material->servicio==1){
                                  $renta=$renta+(($detalle->precio_unitario*$detalle->cantidad)*session('renta'));
                                }
                              @endphp
                              <td><center>{{$correlativo}}</center></td>

                              <td>{{$detalle->material->nombre}}</td>
                              <td><center>{{$detalle->unidad_medida}}</center> </td>
                              <td><center>{{$detalle->cantidad}}</center></td>
                              <td align="left">${{number_format($detalle->precio_unitario,2)}} </td>
                              <td align="left">${{number_format($detalle->precio_unitario*$detalle->cantidad,2)}} </td>
                            </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <!--<tr>

                            <td colspan="5"><center> Total en letras: <b>{{numaletras($total)}}</b></center></td>
                            <th><p align="left">${{number_format($total,2)}}</p></th>
                          </tr>-->

                          <tr>
                            <td colspan="5"> <b>SUB TOTAL</b></td>
                            <th align="left">${{number_format($total,2)}}</th>
                          </tr>
                          <?php //$renta=0.0;
                            ?>
                          <tr>
                            <td colspan="5"> <b>(-) RETENCIÓN RENTA 10% </b></td>
                            <th align="left">${{number_format($renta,2)}}</th>
                          </tr>
                          <?php $total=$total-$renta; ?>
                          <tr>
                            <td colspan="5"> <b>LÍQUIDO A RECIBIR: </b></td>
                            <th align="left">${{number_format(\App\Detallecotizacion::total_cotizacion($ordencompra->cotizacion->id),2)}}</th>
                          </tr>

                        </tfoot>
                      </table>
                    <!--</div>-->
                    <p></p>
                    NOTA: FAVOR EMITIR FACTURA DE CONSUMIDOR FINAL O RECIBO A NOMBRE DE LA TESORERÍA MUNICIPAL DE VERAPAZ
                    <br>

                    <table width="100%" border="" class="table table-striped table-bordered" >
                      <tbody>



                        <tr>
                          <th>LUGAR DE ENTREGA DE LOS SERVICIOS O PRODUCTOS</th>
                          <td>{{$ordencompra->direccion_entrega}}</td>
                        </tr>
                        <tr>
                          <th>CONDICIONES DE PAGO</th>
                          <td>{{$ordencompra->cotizacion->solicitudcotizacion->formapago->nombre}}</td>
                        </tr>
                        <tr>
                          <th width="40%">FUENTE DE FINANCIAMIENTO</th>
                          <td width="60%">
                            @if($ordencompra->cotizacion->solicitudcotizacion->tipo==1)
                            @foreach($ordencompra->cotizacion->solicitudcotizacion->proyecto->fondo as $fondos)
                              {{$fondos->cuenta->nombre}},
                            @endforeach
                            / {{$ordencompra->cotizacion->solicitudcotizacion->proyecto->nombre}}
                          @elseif($ordencompra->cotizacion->solicitudcotizacion->tipo==2)
                            {{$ordencompra->cotizacion->solicitudcotizacion->requisicion->cuenta->nombre}}
                            @else 
                            {{$ordencompra->cotizacion->solicitudcotizacion->solirequi->cuenta->nombre}}
                          @endif
                          </td>
                        </tr>
                        <tr>
                          <th>FECHA DE ENTREGA DE LOS PRODUCTOS O SERVICIOS</th>
                          <td>
                            @if($ordencompra->fecha_fin == "")
                            {{$orden->fecha_inicio->format('d-m-Y')}}
                          @else
                            Desde el {{$ordencompra->fecha_inicio->format('l d')}} de {{$ordencompra->fecha_inicio->format('F')}} del {{$ordencompra->fecha_inicio->format('Y')}} al {{$ordencompra->fecha_fin->format('l d')}} de {{$ordencompra->fecha_fin->format('F')}} del {{$ordencompra->fecha_fin->format('Y')}}
                          @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  
                    <table width="100%" class="table table-bordered">
                      <tbody>
                        <tr>
                          <td>Autoriza:
                            <p></p>
                            F: _______________
                            <p>ALCALDE MUNICIPAL</p>
                          </td>
                          <td>Elaboró Orden de Compra:
                            <p></p>
                            F: _______________
                            <p>JEFE UACI</p>
                          </td>
                          <td>Es conforme:
                            <p></p>
                            F: _______________
                            <p>SUMINISTRANTE</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


