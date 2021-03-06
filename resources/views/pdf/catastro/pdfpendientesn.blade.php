@extends('pdf.catastro.plantilla')
@section('reporte')
  @foreach($ids as $key => $mid)
@php
$factura= App\FacturaNegocio::find($mid);
    $items=$factura->items;
    $total=$factura->subTotal+$factura->mora;
    $fiesta=($factura->porcentajeFiestas);
    $sumat=$total+$fiesta;
    $array_meses=['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
@endphp
<style>
  .table-simple th,.table-simple td{
  border: 1px white solid;
}
</style>
<div id="content">
    <table class="table-simple" width="100%" rules=all>
      <tbody>
        <tr>
          <td style="width: 20%"></td>
          <td colspan="4" style="width: 20%">Verapaz</td>
          <td>{{date('d')}}</td>
          <td>{{$array_meses[intval(date('m')-1)]}}</td>
          <td style="text-align: right">{{date('Y')}}</td>
        </tr>
        <tr>
          <td></td>
          <td colspan="4"></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td style="width: 20%"></td>
          <td colspan="2" style="width: 20%">{{number_format($sumat,2,'.', ',')}}</td>
          <td colspan="2" style="width: 22%" style="color:white"></td>
          <td colspan="3" style="color:white">Cargo en caja, rubros o cuentas</td>
        </tr>
      <tr>
        <td></td>
        <td colspan="4"></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
        <tr>
          <td colspan="3"></td>
          <td colspan="2" style="color:white">mandamiento de ingreso</td>
          <td style="color:white">Fondo municipal</td>
          <td style="color:white">Especif. municpal</td>
          <td style="color:white">Especif. fiscales</td>
        </tr>
        @foreach ($items as $i => $item)
        <tr>
          <td colspan="3">
            @if(($i+1)==1)
            {{$factura->negocio->nombre}}
            @endif
            @if(($i+1)==5)
           
            {{App\Factura::convertir((int)$sumat)}} y {{number_format($sumat-((int)$sumat),2,'.','.')*100}}/100 US DOLARES
            @endif
            @if(($i+1)==9)
           
            {{App\Factura::personal('tesoreria')}}
            @endif
            @if(($i+1)==12)
            
            {{App\Factura::personal('contabilidad')}}
            @endif
            @if(($i+1)==13)
            ----
            @endif
          </td>
          <td colspan="2">
            @if($factura->negocio->tipo_cobro==4)
            Cobro por {{$factura->negocio->numero_cabezas}} cabezas
            @elseif($factura->negocio->tipo_cobro==2)
            Licencia anual
            @else
            {{$item->rubro->nombre}}
            @endif
          </td>
          <td>{{number_format($factura->subTotal,2,'.', ',')}}</td>
          <td></td>
          <td></td>
        </tr>
        @if($factura->mora>0)
        <tr>
          <td colspan="3"></td>
          <td colspan="2">Mora en intereses</td>
          <td>{{number_format($factura->mora,2)}}</td>
          <td></td>
          <td></td>
        </tr>
        @endif
        @endforeach
        @php
            $bandera=true;
        @endphp
        @for($a=$items->count();$a<12;$a++)
        <tr>
          <td colspan="3">           
              @if(($a+1)==1)
              {{$factura->negocio->nombre}}
              @endif
              @if(($a+1)==5)
              {{App\Factura::convertir((int)$sumat)}} y {{number_format($sumat-((int)$sumat),2,'.','.')*100}}/100 USD DOLARES
              @endif
              @if(($a+1)==9)
              {{App\Factura::personal('tesoreria')}}
              @endif
              @if(($a+1)==7)
              Factura correspodiente a: {{$factura->mesYear}}
              @endif
              @if(($a+1)==12)
              {{App\Factura::personal('contabilidad')}}
              @endif
            </td>
          @if($bandera)
          <td colspan="2">
          Fiestas patronales
          </td>
          <td>{{number_format($fiesta,2,'.', ',')}} </td>
          @else
          <td colspan="2" style="color:white">{{$a+1}}
          </td>
          <td></td>
          @endif
          <td></td>
          <td></td>
        </tr>

        @php
            $bandera=false;
        @endphp
        @endfor
        <tr>
          <td colspan="3"></td>
          <td colspan="2" style="color:white">Totales</td>
          <td>{{number_format($sumat,2,'.', ',')}}</td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  @if($key<(count($ids)-1))
  <div style="page-break-after:always;"></div>
  @endif
  @endforeach
@endsection
