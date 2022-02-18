@extends('pdf.plantilla')
@section('reporte')
@include('pdf.tesoreria.cabecera')
@include('pdf.tesoreria.pie')
<style>
	p{
		font-size: 17px;
	}
</style>
<div id="content">
	
		<table class="table table-hover" width="100%" rules="all">
			<td class="text-center">
				<h4>NIT de alcaldia municipal: {{$configuracion->nit_alcaldia}}</h4>
			</td>
		</table>
	
	<p style="text-align: center"><strong>Concepto:</strong> {{ $pagorentas->concepto }}</p>
	<p style="text-align: center"><strong>Monto servicio:</strong> ${{ number_format($pagorentas->total,2)}}</p>
	<p style="text-align: center"><strong>Monto retenido:</strong> ${{ number_format($pagorentas->renta,2)}}</p>
	<p style="text-align: center"><strong>Líquido a pagar:</strong> ${{ number_format($pagorentas->liquido,2)}}</p>
	<p style="text-align: center"><strong>Nombre sujeto de retención:</strong> {{ $pagorentas->nombre }}</p>
	<p style="text-align: center"><strong>DUI:</strong> {{ $pagorentas->dui }}</p>
	<p style="text-align: center"><strong>NIT:</strong> {{ $pagorentas->nit }}</p>
	<p style="text-align: center"><strong>Firma:</strong> _____________</p>
</div>
@endsection