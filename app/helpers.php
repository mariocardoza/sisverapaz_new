<?php
use App\Bitacora;
use App\Presupuesto;
use App\Cargo;
use App\Porcentaje;
use App\Role;
use App\LogTarifa;
use Illuminate\Http\Request;
use App\Bitacora as LogActivityModel;


function invertir_fecha($fecha)
{
	$inicio = $fecha; //dd-mm-yyyy
	if($inicio==null){
		return "";
	}else{
		$invert = explode("-",$inicio);
        $nueva = $invert[2]."-".$invert[1]."-".$invert[0];
        return $nueva;
  }
}

function nombre_tarifa($id,$tabla){
    switch ($tabla) {
        case 'Tiposervicio':
            $tipo = \App\Tiposervicio::find($id);
            return $tipo->nombre;
            break;
        case 'Rubro':
            $tipo = \App\Rubro::find($id);
            return $tipo->nombre;
            break;
        default:
            return 'No definido';
            break;
    }
}

function userIdByRole($role){
    $role = Role::where('name',$role)->first();
    if(!is_null($role)){
        return $role->roleuser->user_id;
    }
}

function bitacora($accion,$table='')
{
	$log = [];
    $log['tabla'] = $table==''? '-':$table;
	$log['accion'] = $accion;
	$log['url'] = Request()->fullUrl();
	$log['method'] = Request()->method();
	$log['ip'] = Request()->ip();
	$log['agent'] = Request()->header('user-agent');
	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;
	LogActivityModel::create($log);
}

function get_browser_name($user_agent)
{
        // Make case insensitive.
    $t = strtolower($user_agent);
    $t = " " . $t;

    // Humans / Regular Users     
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    elseif (strpos($t, 'symfony'   )                           ) return 'Consola administrativa';

    // Common Tools and Bots
    elseif (strpos($t, 'mj12bot'   )                           ) return '[Bot] Majestic'     ;
    elseif (strpos($t, 'ahrefs'    )                           ) return '[Bot] Ahrefs'       ;
    elseif (strpos($t, 'semrush'   )                           ) return '[Bot] SEMRush'      ;
    elseif (strpos($t, 'rogerbot'  ) || strpos($t, 'dotbot')   ) return '[Bot] Moz or OpenSiteExplorer';
    elseif (strpos($t, 'frog'      ) || strpos($t, 'screaming')) return '[Bot] Screaming Frog';
   
    // Miscellaneous
    elseif (strpos($t, 'facebook'  )                           ) return '[Bot] Facebook'     ;
    elseif (strpos($t, 'pinterest' )                           ) return '[Bot] Pinterest'    ;
   
    // Check for strings commonly used in bot user agents  
    elseif (strpos($t, 'crawler' ) || strpos($t, 'api'    ) ||
            strpos($t, 'spider'  ) || strpos($t, 'http'   ) ||
            strpos($t, 'bot'     ) || strpos($t, 'archive') ||
            strpos($t, 'info'    ) || strpos($t, 'data'   )    ) return '[Bot] Other'   ;
   
    return 'Otro (Sin identificar)';
}



function obtenerMes($n){
    if($n==1){
        return "enero";
    }elseif($n==2){
        return "febrero";
    }elseif($n==3){
        return "marzo";
    }elseif($n==4){
        return "abril";
    }elseif($n==5){
        return "mayo";
    }elseif($n==6){
        return "junio";
    }elseif($n==7){
        return "julio";
    }elseif($n==8){
        return "agosto";
    }elseif($n==9){
        return "septiembre";
    }elseif($n==10){
        return "octubre";
    }elseif($n==11){
        return "noviembre";
    }elseif($n==12){
        return "diciembre";
    }
}

function retornar_porcentaje($dato)
{
    $porcentajes=Porcentaje::where('nombre_simple',$dato)->first();
    $valor=0;
    $valor=$porcentajes->porcentaje/100;
    return $valor;
}

function retornar_renta_servicio()
{
    $porcentajes=Porcentaje::where('es_servicio',true)->first();
    $valor=0;
    $valor=$porcentajes->porcentaje/100;
    return $valor;
}

function el_porcentaje($dato)
{
    $porcentajes=Porcentaje::where('nombre_simple',$dato)->first();
    $valor=0;
    $valor=$porcentajes->porcentaje;
    return $valor;
}

function tamaniohumano($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    function duicero($dui)
    {
        $cantidad = strlen((int)$dui);
        switch ($cantidad) {
            case 7:
                return 'CERO';
                break;

                case 6:
                return 'CERO CERO';
                break;

                case 5:
                return 'CERO CERO CERO';
                break;

                case 4:
                return 'CERO CERO CERO CERO';
                break;

            default:
                # code...
                break;
        }

    }

    function duinitultimo($numero)
    {
        switch ($numero) {
            case '0':
                return 'CERO';
                break;

                case '1':
                return 'UNO';
                break;

                case '2':
                return 'DOS';
                break;

                case '3':
                return 'TRES';
                break;

                case '4':
                return 'CUATRO';
                break;

                case '5':
                return 'CINCO';
                break;

                case '6':
                return 'SEIS';
                break;

                case '7':
                return 'SIETE';
                break;

                case '8':
                return 'OCHO';
                break;

                case '9':
                return 'NUEVE';
                break;

            default:
                # code...
                break;
        }
    }

    function nitprimero($nit)
    {
        $cantidad = strlen((int)$nit);
        if ($cantidad == 3)
        {
            return 'CERO';
        }
    }

    function nitsegundo($nit)
    {
        $cantidad = strlen((int)$nit);
        if ($cantidad == 5)
        {
            return 'CERO';
        }
    }

    function nittercero($nit)
    {
        $cantidad = strlen((int)$nit);
        if ($cantidad == 1)
        {
            return 'CERO CERO';
        }
        if($cantidad == 2)
        {
            return 'CERO';
        }
    }


function fechaCastellano ($fecha)
{
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Mi??rcoles", "Jueves", "Viernes", "S??bado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function periododetiempo($fechaInicio,$fechaFin)
{
    $fecha1 = new DateTime($fechaInicio);
    $fecha2 = new DateTime($fechaFin);
    $fecha = $fecha1->diff($fecha2);
    $tiempo = "";

    //a??os
    if($fecha->y > 0)
    {
        $tiempo .= $fecha->y;

        if($fecha->y == 1)
            $tiempo .= " a??o, ";
        else
            $tiempo .= " a??os, ";
    }

    //meses
    if($fecha->m > 0)
    {
        $tiempo .= $fecha->m;

        if($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }

    //dias
    if($fecha->d > 0)
    {
        $tiempo .= $fecha->d;

        if($fecha->d == 1)
            $tiempo .= " d??a, ";
        else
            $tiempo .= " d??as, ";
    }

    return $tiempo;
}

function cantprov()
{
	$proveedores = App\Proveedor::all()->where('estado',1);
	$count=$proveedores->count();
    return $count;
}

function nombre_proyecto($id)
{
	$proyecto = App\Proyecto::where('id',$id)->first();
	return $proyecto->nombre;
}

function cantcontri()
{
    $contribuyentes = App\Contribuyente::all()->where('estado',1);
    $count=$contribuyentes->count();
    return $count;
}

function prestamos($id)
{
	$prestamo = App\Prestamo::where('empleado_id',$id)->first();
	dd($prestamo->monto);
	$monto = $prestamo->monto;
	return $monto;
}

/*function bitacora($accion)
{

	$bitacora = new Bitacora;
	$bitacora->registro = date('Y-m-d');
	$bitacora->hora = date('H:i:s');
	$bitacora->accion = $accion;
	$bitacora->user_id = Auth()->user()->id;
	$bitacora->save();
}*/

function usuario($id)
{
	$empleado = App\Empleado::where('id',$id)->first();
	return $empleado->nombre;
}

function vercargo($cargo)
{
	switch ($cargo) {
		case '1':
			return 'Administrador';
			break;
		case '2':
			return 'Jefe UACI';
			break;
		case '3':
			return 'Jefe Tesorer??a';
				break;
		case '4':
			return 'Jefe Registro y Control Tributario';
			break;
		case '5':
			return 'Colectur??a';
			break;
		default:

			break;
	}
}

function proyecto_estado($estado,$id)
{
    $proyecto=\App\Proyecto::find($id);
    if($proyecto->tipo_proyecto==1):
        switch ($estado) {
            case '1':
                return 'Aprobado';
                break;
            case '2':
                return 'Realizando el presupuesto';
                break;
            case '3':
                return 'En proceso de cotizaci??n';
                break;
            case '4':
                return 'Recibiendo cotizaciones';
                break;
            case '5':
                return 'En proceso de adjudicaci??n';
                break;
            case '6':
                return 'En proceso de emisi??n de orden de compra';
                break;
            case '7':
                return 'Pendiente de recibir materiales';
                break;
            case '8':
                return 'En marcha';
                break;
            case '9':
                return 'En pausa';
                break;
            case '10':
                return 'Inactivo';
                break;
            case '11':
                return 'Rechazado';
                break;
            case '12':
                return 'Pendiente de liquidaci??n';
                break;
            case '13':
                return 'Finalizado';
                break;
            default:
                            return 'Sin clasificar';
                break;
        }
    else:
        switch ($estado) {
            case '1':
                return 'Licitaci??n aprobada';
                break;
            case '2':
                return 'Estableciendo las actividades';
                break;
            case '3':
                return 'Bases listas para descarga';
                break;
            case '4':
                return 'Recibiendo ofertas';
                break;
            case '5':
                return 'Ofertante seleccionado';
                break;
            case '6':
                return 'Contrato subido';
                break;
            case '7':
                return 'En ejecuci??n';
                break;
            case '8':
                return 'En pausa';
                break;
            case '9':
                return 'Inactivo';
                break;
            case '10':
                return 'Rechazado';
                break;
            case '11':
                return 'Pendiente de liquidaci??n';
                break;
            default:
                return 'Sin clasificar';
                break;
        }
    endif;
}

function estilo_proyecto($estado,$id)
{
    $proyecto=\App\Proyecto::find($id);
    if($proyecto->tipo_proyecto==1):
        switch ($estado) {
                case '1':
                        return 'primary';
                        break;
                case '2':
                        return 'warning';
                        break;
                case '3':
                        return 'warning';
                        break;
                case '4':
                        return 'warning';
                        break;
                case '5':
                        return 'warning';
                        break;
                case '6':
                        return 'success';
                        break;
                case '7':
                        return 'primary';
                        break;
                case '8':
                        return 'success';
                        break;
                case '9':
                        return 'danger';
                        break;
                case '10':
                        return 'danger';
                        break;
                case '11':
                        return 'danger';
                        break;
                case '12':
                        return 'info';
                        break;
                case '13':
                        return 'success';
                        break;
                default:
                        return 'default';
                        break;
        }
    else:
        switch ($estado) {
            case '1':
                    return 'primary';
                    break;
            case '2':
                    return 'info';
                    break;
            case '3':
                    return 'info';
                    break;
            case '4':
                    return 'info';
                    break;
            case '5':
                    return 'success';
                    break;
            case '6':
                    return 'success';
                    break;
            case '7':
                    return 'success';
                    break;
            case '8':
                    return 'warning';
                    break;
            case '9':
                    return 'danger';
                    break;
            case '10':
                    return 'danger';
                    break;
            case '11':
                    return 'success';
                    break;
            default:
                    return 'default';
                    break;
    }
    endif;

}

function presupuesto($proyecto_id)
{
	$presupuesto = App\Presupuesto::all()->where('proyecto_id',$proyecto_id);
	$count=$presupuesto->count();
    return $count;
}

function numletras($xcifra)
{
    $xarray = array(0 => "CERO",
       1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l??mite a 6 d??gitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg?? al l??mite m??ximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d??gitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d??gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n??mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = nombre($xaux); // devuelve el nombre correspondiente (Mill??n, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu?? si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l??gica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = nombre($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = nombre($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta l??nea la puedes cambiar de acuerdo a tus necesidades o a tu pa??s -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        //$xcadena = "CERO PESOS $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        //$xcadena = "UN PESO $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        //$xcadena.= " PESOS $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para M??xico se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace(" ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

function numaletras($xcifra)
{
    $xarray = array('0' => "CERO",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		$xdecimales1=numletras($xdecimales);
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l??mite a 6 d??gitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg?? al l??mite m??ximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d??gitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d??gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n??mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = sub_fijo($xaux); // devuelve el sub_fijo correspondiente (Mill??n, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu?? si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l??gica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = sub_fijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = sub_fijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta l??nea la puedes cambiar de acuerdo a tus necesidades o a tu pa??s -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
					if ($xcifra < 0) {
                        $xcadena = " $xdecimales1 CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA";
                    }
					if ($xcifra < 1) {
					if($xdecimales=="00"){
						//$xdecimales1="CERO";
					    $xcadena.= " CERO DOLARES CON CERO CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA " ; //
						}else{
                        $xcadena = "$xdecimales1 CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA";
                    }
					}
					if ($xcifra == 1) {
                        $xcadena.= " D??LAR EXACTO";
                    }

                    if ($xcifra > 1 && $xcifra < 2) {
					 //  $xdecimales1=numaletras($xdecimales);
                        $xcadena = "UN D??LAR CON $xdecimales1 CENTAVOS";
                    }

					 if ($xcifra == 2 ) {
					    $xcadena.= " 00/100 " ; //
//						return 0;
                    }

                    if ($xcifra > 2) {
						if($xdecimales=="00"){
						//$xdecimales1="CERO";
					    $xcadena.= " 00/100 D??LARES" ; //
						}else{
						$xcadena.= " $xdecimales/100 D??LARES" ; //
						}
//						return 0;
                    }
                    break;

            } // endswitch ($xz)

        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para M??xico se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda


    } // ENDFOR ($xz)

    return trim($xcadena);

}

// END FUNCTION

function sub_fijo($xx)
{ // esta funci??n regresa un sub_fijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

function nombre($xx)
{ // esta funci??n regresa un nombre para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

function num_letras($xcifra)
{
    $xarray = array('0' => "CERO",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		$xdecimales1=numletras($xdecimales);
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l??mite a 6 d??gitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg?? al l??mite m??ximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d??gitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d??gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n??mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = sub_fijo($xaux); // devuelve el sub_fijo correspondiente (Mill??n, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu?? si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l??gica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = sub_fijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = sub_fijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta l??nea la puedes cambiar de acuerdo a tus necesidades o a tu pa??s -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
					if ($xcifra < 0) {
                        $xcadena = " $xdecimales1 CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA";
                    }
					if ($xcifra < 1) {
					if($xdecimales=="00"){
						//$xdecimales1="CERO";
					    $xcadena.= " CERO DOLARES CON CERO CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA " ; //
						}else{
                        $xcadena = "$xdecimales1 CENTAVOS DE D??LAR DE LOS ESTADOS UNIDOS DE AMERICA";
                    }
					}
					if ($xcifra == 1) {
                        $xcadena.= " D??LAR EXACTO";
                    }

                    if ($xcifra > 1 && $xcifra < 2) {
					 //  $xdecimales1=numaletras($xdecimales);
                        $xcadena = "UN D??LAR CON $xdecimales1 CENTAVOS";
                    }

					 if ($xcifra == 2 ) {
					    $xcadena.= " 00/100 " ; //
//						return 0;
                    }

                    if ($xcifra > 2) {
						if($xdecimales=="00"){
						//$xdecimales1="CERO";
					    $xcadena.= " 00/100 D??LARES" ; //
						}else{
						$xcadena.= " $xdecimales/100 D??LARES" ; //
						}
//						return 0;
                    }
                    break;

            } // endswitch ($xz)

        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para M??xico se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda


    } // ENDFOR ($xz)

    return trim($xcadena);

}

