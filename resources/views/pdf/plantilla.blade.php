<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SisVerapaz</title>
  <link type="text/css" media="all" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Latest compiled and minified CSS -->
  <style>
    
    /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
             @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 3.5cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
        </style>
        </style>

  </style>
</head>
<body>
@yield('reporte')
<script type="text/php"> 

  if (isset($pdf)) { 

   //$font = Font_Metrics::get_font("helvetica", "bold"); 
   $pdf->page_text(500,720, "Página: {PAGE_NUM} de {PAGE_COUNT}", '', 10, array(0,0,0)); 

  } 
  </script>
</body>
</html>
