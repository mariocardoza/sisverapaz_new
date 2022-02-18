@extends('pdf.plantilla')
@section('reporte')
@include('pdf.uaci.cabecera')
@include('pdf.uaci.pie')
  <div id="content">
    <p>Proceso N°: {{$solicitud->presupuesto->proyecto->nombre}}</p>
    <table rules="all" class="table table-bordered table-striped table-hover table-condensed" width="100%">
                            <tr>
                              <td>
                                <table rules="all" width="100%">
                                  <thead>
                                    <tr>
                                      <th colspan="3"><center><small>CONDICIONES</small></center></th>
                                    </tr>
                                    <tr>
                                      <th width="25%"><small>RUBRO</small></th>
                                      <th width="25%"><small>CANTIDAD</small></th>
                                      <th width="50%"><small>DESCRIPCIÓN</small></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($detalles as $detalle)
                                      <tr>
                                        <td><small>Adquisic</small></td>
                                        <td><small>{{$detalle->cantidad}}</small></td>
                                        <td><small>{{$detalle->catalogo->nombre}}</small></td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr><th colspan="3"><small>Total de la oferta</small></th></tr>
                                    <tr><th colspan="3"><small>Total adjudicado</small></th></tr>
                                    <tr><th colspan="3"><small>Validez de la oferta (plazo)</small></th></tr>
                                    <tr><th colspan="3"><small>Forma de pago</small></th></tr>
                                    <tr><th colspan="3"><small>Plazo de entrega</small></th></tr>
                                    <tr><th colspan="3"><small>Oferente adjudicado</small></th></tr>
                                  </tfoot>
                                </table>
                              </td>

                              @foreach($cotizaciones as $cotizacion)
                               <td>

                                <table rules="all" border="1px" width="100%" class="">
                                  <?php $total=0.0;?>
                                  <thead>
                                    <tr>
                                      <th heigth="5px" colspan="3">
                                        <center><small>OFERENTE: {{$cotizacion->proveedor->nombre}}</small><</center>
                                      </th>
                                    </tr>
                                    <tr>
                                      <th width="50%"><small>MARCA</small></th>
                                      <th width="25%"><small>PRECIO</small></th>
                                      <th width="25%"><small>TOTAL</small></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($cotizacion->detallecotizacion as $detalle2)
                                    <?php
                                      $total=$total+$detalle2->cantidad*$detalle2->precio_unitario;
                                    ?>
                                      <tr>
                                        <td><small>{{$detalle2->marca}}</small></td>
                                        <td><small>${{number_format($detalle2->precio_unitario,2)}}</small></td>
                                        <td><small>${{number_format($detalle2->cantidad*$detalle2->precio_unitario,2)}}</small></td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <th colspan="2"></th>
                                      <th><small>${{number_format($total,2)}}</small></th>
                                    </tr>
                                    
                                    <tr><th colspan="3"><small>@if($cotizacion->seleccionado==true)${{number_format($total,2)}}
                                      @else {{"-"}}
                                    @endif</small></th></tr>
                                    <tr><th colspan="3"><small>{{$cotizacion->descripcion}}</small></th></tr>
                                    <tr><th colspan="3"><small>{{$cotizacion->descripcion}}</small></th></tr>
                                    <tr><th colspan="3"><small>{{$solicitud->solicitudcotizacion->formapago->nombre}}</small></th></tr>
                                    <tr><th colspan="3"><small>{{$solicitud->solicitudcotizacion->tiempo_entrega}}</small></th></tr>
                                    <tr><th colspan="3">@if($cotizacion->seleccionado==true)<small>{{$cotizacion->seleccionado}}
                                      @else {{"-"}}
                                    @endif</small></th></tr>

                                  </tfoot>
                                </table>
                                </td>
                              @endforeach
                          </table>

                          SE SELECCIONA ESTA OFERTA POR SER LA MÁS BAJA EN PRECIO Y OFRECE LOS PRODUCTOS EN LAS CONDICIONES REQUERIDAS

                          <p>Aspecto de la selección: Menor precio              Calidad</p>
                          <p>Elaboró:{{$solicitud->solicitudcotizacion->encargado}} .............................................................................. Adjudicó:{{}}</p>

</div>
@endsection
