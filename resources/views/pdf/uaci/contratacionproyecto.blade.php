<!DOCTYPE html>
<html lang="es" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Contrato de servicios {{$contratacionproyecto->empleado->nombre}}</title>
	</head>
	<body>

			<center><h4>ALCALDÍA MUNICIPAL DE VERAPAZ, DEPARTAMENTO DE SAN VICENTE</h4></center>
			<center><h4>CONTRATO DE SERVICIOS</h4></center>

				<?php
				$duia = $contratacionproyecto->empleado->dui;
				$dui = explode('-',$duia);
				$nita = $contratacionproyecto->empleado->nit;
				$nit = explode('-',$nita);
				$dui2=$alcaldia->dui_alcalde;
				$duial= explode('-',$dui2);
				$nit2 = $alcaldia->nit_alcalde;
				$nital=explode('-',$nit2);
				$nit3=$alcaldia->nit_alcaldia;
				$nitalcaldia=explode('-',$nit3);
				setlocale(LC_TIME,"es_ES");
				?>


					<p align="justify" style="line-height:25px; font-size:12;">

					NOSOTROS, {{mb_strtoupper($alcaldia->nombre_alcalde)}}, de {{NumeroALetras::convertir($alcaldia->nacimiento_alcalde->age)}} años de edad, {{$alcaldia->oficio_alcalde}},
					del domicilio de VERAPAZ, Departamento de San Vicente, portador de mi Documento Único de Identidad Número {{duicero($duial[0])}} {{ NumeroALetras::convertir($duial[0]) }} - {{ duinitultimo($duial[1]) }},
					con mi Número de Identificación Tributaría {{nitprimero($nital[0])}} {{ NumeroALetras::convertir($nital[0]) }}- {{ nitsegundo($nital[1]) }} {{ NumeroALetras::convertir($nit[1]) }}- {{nittercero($nital[2])}} {{NumeroALetras::convertir($nital[2])}}- {{duinitultimo($nital[3])}}, actuando en nombre y representación, en mi carácter de Alcalde Municipal, de la Alcaldía Municipal de Verapaz,
					Departamento de San Vicente, con Número de Identificación Tributaría {{nitprimero($nitalcaldia[0])}} {{ NumeroALetras::convertir($nitalcaldia[0]) }}- {{ nitsegundo($nitalcaldia[1]) }} {{ NumeroALetras::convertir($nitalcaldia[1]) }}- {{nittercero($nitalcaldia[2])}} {{NumeroALetras::convertir($nitalcaldia[2])}}- {{duinitultimo($nitalcaldia[3])}}; situación que compruebo con la
					Credencial Emitida por el Tribunal Supremo Electoral, en la que consta que he sido electo al cargo en mención, para el período constitucional que comprende del PERIODO DE ALCALDE, los que me conceden facultades para firmar en el carácter en que actúo contrato como el presente, que en lo sucesivo y en el transcurso del presente "El Contratante" por una parte y  por otra parte
					el/la señor/a {{mb_strtoupper ($contratacionproyecto->empleado->nombre)}} de {{ NumeroALetras::convertir($contratacionproyecto->empleado->fecha_nacimiento->age) }} años de edad, OFICIO EMPLEADO, del domicilio de MUNICIPIO, DEPARTAMENTO  y portador de mi Documento Único de Identidad número, {{duicero($dui[0])}} {{ NumeroALetras::convertir($dui[0]) }} - {{ duinitultimo($dui[1]) }} ,
					con Número de Identificación Tributaria {{nitprimero($nit[0])}} {{ NumeroALetras::convertir($nit[0]) }}- {{ nitsegundo($nit[1]) }} {{ NumeroALetras::convertir($nit[1]) }}- {{nittercero($nit[2])}} {{NumeroALetras::convertir($nit[2])}}- {{duinitultimo($nit[3])}}; quien en este instrumento se denominará “El Contratista”, convenimos celebrar el presente <b>CONTRATO DE PRESTACIÓN DE SERVICIOS:</b>
					El primero en la calidad en que actúa en nombre y representación de la Alcaldía Municipal de Verapaz, Departamento de San Vicente, CONTRATA a la segunda como {{mb_strtoupper($contratacionproyecto->cargo)}} dentro del proyecto "{{mb_strtoupper($contratacionproyecto->contratoproyecto->proyecto->nombre)}}"; conforme a las cláusulas que se detallan a continuación:

					<b>PRIMERA - DESCRIPCIÓN DEL TRABAJO:</b> La contratista desempeñará la función de {{$contratacionproyecto->cargo}} desempeñando las actividades que el encargado del proyecto estime convenientes. Deberá desempeñar ademas las funciones de: @foreach($contratacionproyecto->epfuncione as $funcion){{$funcion['funcion']}}@endforeach
					<b>SEGUNDA - PLAZO:</b> El plazo de vigencia de este contrato es de <b>{{mb_strtoupper(periododetiempo($contratacionproyecto->contratoproyecto->inicio_contrato,$contratacionproyecto->contratoproyecto->fin_contrato))}}</b> que inician con la firma del presente contrato, es decir del día PERIODO. Dicho contrato podrá ser prorrogado siempre y cuando las partes lo estimen conveniente.

					<b>TERCERA - SALARIO Y FORMA DE PAGO:</b> Los pagos serán mensuales, por un monto de <b>{{numaletras($contratacionproyecto->salario)}} DE LOS ESTADOS UNIDOS DE AMERICA (${{number_format($contratacionproyecto->salario,2)}})</b> menos el impuesto sobre la renta; por medio de cheque bancario o transferencia electronica a cuenta de ahorro en el Baco Hipotecario, pagado el último dia hábil de cada mes.

					<b>CUARTA - HORARIO LABORAL:</b> La jornada laboral será de lunes a viernes, en horario de {{date('h:i A', strtotime($contratacionproyecto->contratoproyecto->hora_entrada))}} a {{date('h:i A', strtotime($contratacionproyecto->contratoproyecto->hora_salida))}} y deberá firmar la lista de asistencia que será proporcionada por su jefe inmediato.

					<b>QUINTA - SUSPENCIÓN DEL CONTRATO:</b> El contrato podrá ser resuelto o darse por terminado por terminado antes del plazo por las normas establecidas ne las Leyes de El Salvador, por parte del Contratante por las siguientes causas: Fallecimiento, incapacidad, ausencia injustificada, indisciplina, o incumpliento de una o más cláusulas de este contrato, en el entendido que estas no son
					causas taxativas sino mas bien ejemplificativas es decir pueden existir otras que no esten nominadas aquí, las cuales quedaran a criterio del contratante. El contratante cancelará mes calendario, por tanto, considerará desde el 1 de {{strftime("%B", strtotime($contratacionproyecto->contratoproyecto->inicio_contrato))}}, pero no estará obligado a pagar indemnización por el servicio contratado.
					En el caso de incapacidad, enfermedad o fallecimiento, el pago de los días trabajados se hara efectivo se hará efectivo al conyuge o a los beneficiarios con la representación de la debida documentación legal que compruebe su parentesco, la incapacidad o defunción.

					<b>SEXTA - ARBITRAJE:</b> Toda duda o discrepancia que surja con motivo de la vigencia, interpretación o ejecución del contrato y que no pueda ser resuelta entre las partes, deberá ser sometida para decisión final de árbitros arbitradores de la siguiente forma: cada parte nombrará un árbitro y estos nombrarán a su vez un tercero por mutuo acuerdo, para el caso de la discordia.

					<b>SEPTIMA - MODIFICACIONES DEL CONTRATO:</b> Este contrato podrá ser modificado por acuerdo escrito entre las partes, y la modificación deberá deberá legalizarse en la misma forma, emitiendo la Resolución correspondiente que será firmada por ambas partes y aprobada por "El contratante".

					<b>OCTAVA - JURISDICCIÓN:</b> "@if($contratacionproyecto->empleado->sexo == "Femenino")La @else El @endif Contratista" se somete a las Leyes de El Salvador y en caso de acción judicial señala como su domicilio el de esta ciudad, a la judisdicción de cuyos Tribunales se somete.

					<b>NOVENA - NOTIFICACIONES:</b> Las notificaciones entre las partes deberán hacerse por escrito y tendrán efecto a partir de su recepción en las direcciones que acontinuación se indican: Para "El contratante": DIRECCIÓN: {{$alcaldia->direccion_alcaldia}}; al Correo: {{$alcaldia->email_alcaldia}} o al teléfono: {{$alcaldia->telefono_alcaldia}}; para "@if($contratacionproyecto->empleado->sexo == "Femenino")La @else El @endif Contratista":
						 DIRECCIÓN: {{$contratacionproyecto->empleado->direccion}}. Las partes contratadas podemos cambiar dirección, quedando en este caso, una de ellas, obligada a notificarlo a la otra; mientras tanto la última notificación será la válida para los efectos legales.

					<b>DECIMA - VIGENCIA:</b> Este contrato tendrá vigencia a partir de la fecha en que sea aprobado por el El contratante, pero para los efectos de computación del tiempo de duración y pago a "@if($contratacionproyecto->empleado->sexo == "Femenino")La @else El @endif Contratista", se regirá a partir del UNO de {{mb_strtoupper(strftime("%B", strtotime($contratacionproyecto->contratoproyecto->inicio_contrato)))}} del año
						{{NumeroALetras::convertir($contratacionproyecto->contratoproyecto->inicio_contrato->format('Y'))}}.
					Así nos expresamos los comparecientes, y consientes de los términos y efectos legales del presente contrato, en fe de lo cual ratificamos su contenido y firmamos por estar redactados conforme a nuestras voluntades, en la ciudad de Verapaz, a los FECHA DE FIRMA EN LETRAS.

					</p>
				<br>
				<br>
				<br>
					<table width="100%">
						<tr>
							<td width="50%" align="left"><center>{{$alcaldia->nombre_alcalde}}</center></td>
							<td width="50%" align="right"><center>{{$contratacionproyecto->empleado->nombre}}</center></td>
						</tr>
						<tr>
							<td align="left"><center>Contratante</center></td>
							<td align="right"><center>Contratista</center></td>
						</tr>
					</table>
	</body>
</html>
