<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    $users = \App\User::all()->count();
    $roles = \App\Role::all();
    $configuracion = \App\Configuracion::first();

    //if ($users == 0) {
      //return view('auth/register', compact('roles'));
    //} else {
      return view('auth/login',compact('configuracion'));
    //}
});

Route::get('municipios/{id}',function($departamento_id){
  $municipios = \App\Municipio::where('departamento_id',$departamento_id)->get();
  $options='<option selected value=""> Seleccione Municipio</option>';
    foreach ($municipios as $municipality) {
      $options.='<option value="' . $municipality->id . '">' . $municipality->nombre . '</option>';
    }
    return array(1, $municipios, $options);

});

Route::get('losrubros/{id}',function($categoriarubro_id){
  $rubros = \App\Rubro::where('categoriarubro_id',$categoriarubro_id)->get();
  $options='<option selected value=""> Seleccione un rubro</option>';
    foreach ($rubros as $rubro) {
      $options.='<option value="' . $rubro->id . '">' . $rubro->nombre . '</option>';
    }
    return array(1, $rubros, $options);
});

Route::get('pdf',function(){
  $usuarios = \App\Proveedor::where('estado',1)->get();
  $unidad = "Unidad de Adquicisiones Institucionales";
  $pdf = \PDF::loadView('pdf.pdf',compact('usuarios','unidad'));
  $pdf->setPaper('letter', 'portrait');
  //$canvas = $pdf ->get_canvas();
//$canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
  return $pdf->stream('reporte.pdf');
});
//rutas para autorizaciones del administrador
Route::Post('autorizacion', 'Homecontroller@autorizacion');

///////////  RUTAS DE RESPALDO Y RESTAURAR BASE DE DATOS
Route::get('backups','BackupController@index')->name('backups.index');
Route::get('backups/create','BackupController@create')->name('backup.create');
Route::get('backups/descargar/{file_name}','BackupController@descargar');
Route::get('backups/eliminar/{file_name}', 'BackupController@eliminar');
Route::get('backups/restaurar/{file_name}', 'BackupController@restaurar');

//CONFIGURACIONES DE LA ALCALDIA
Route::get('rentas','RentaController@index')->name('rentas.index');
Route::get('arbitrio','ArbitrioController@index')->name('arbitrio.index');
Route::put('rentas/{id}','RentaController@update')->name('rentas.update');
Route::put('arbitrio/{id}','ArbitrioController@update')->name('arbitrio.update');
Route::get('configuraciones','ConfiguracionController@create')->name('configuraciones.create');
Route::post('configuraciones/porcentajes','ConfiguracionController@porcentajes')->name('configuraciones.porcentajes');
Route::post('configuraciones/retenciones','ConfiguracionController@retenciones')->name('configuraciones.retenciones');
Route::post('configuraciones/limites','ConfiguracionController@limitesproyecto')->name('configuraciones.limites');
Route::post('configuraciones/alcaldia','ConfiguracionController@alcaldia')->name('configuraciones.alcaldia');
Route::put('configuraciones/ualcaldia/{configuracione}','ConfiguracionController@ualcaldia')->name('configuraciones.ualcaldia');
Route::put('configuraciones/ulimites/{configuracione}','ConfiguracionController@ulimitesproyecto')->name('configuraciones.ulimites');
Route::post('configuraciones/alcalde','ConfiguracionController@alcalde')->name('configuraciones.alcalde');
Route::put('configuraciones/ualcalde/{configuracione}','ConfiguracionController@ualcalde')->name('configuraciones.ualcalde');
Route::post('configuraciones/logo/{id}','ConfiguracionController@logo')->name('configuraciones.logo');
Route::post('configuraciones/logo_gobierno/{id}','ConfiguracionController@logoGobierno')->name('configuraciones.logo_gobierno');

Auth::routes([
  'login' => true,
  'register' => false, 
  'reset' => true, 
  'verify' => true, 
]);

Route::post('authenticate','Auth\LoginController@authenticate')->name('authenticate');

Route::get('/home', 'HomeController@index')->name('home');
//administrador
Route::post('usuarios/baja/{id}','UsuarioController@baja')->name('usuarios.baja');
Route::post('usuarios/alta/{id}','UsuarioController@alta')->name('usuarios.alta');
Route::Resource('usuarios','UsuarioController');

//Route::Resource('bitacoras' , 'BitacoraController');
Route::get('bitacoras','BitacoraController@index')->name("bitacoras.index");
Route::get('bitacoras/general','BitacoraController@general');
Route::get('bitacoras/usuario','BitacoraController@usuario');
Route::get('bitacoras/fecha','BitacoraController@fecha');

//Perfil de usuario
route::get('home/perfil','UsuarioController@perfil');
route::get('perfil/{id}','UsuarioController@modificarperfil');
Route::put('updateperfil','UsuarioController@updateperfil');
Route::get('avatar','UsuarioController@avatar');
Route::post('usuarios/updateprofile', 'UsuarioController@actualizaravatar');

//////////////////////////////////// UACI /////////////////////////////////////////////////////
Route::post('proveedores/baja/{id}','ProveedorController@baja')->name('proveedores.baja');
Route::post('proveedores/alta/{id}','ProveedorController@alta')->name('proveedores.alta');
Route::Resource('proveedores','ProveedorController');
Route::post('giros/baja/{id}','GiroController@baja')->name('giros.baja');
Route::post('giros/alta/{id}','GiroController@alta')->name('giros.alta');
Route::Resource('giros','GiroController');
Route::post('proveedores/representante/{id}','ProveedorController@representante');
Route::post('especialistas/baja/{id}','EspecialistaController@baja')->name('especialistas.baja');
Route::post('especialistas/alta/{id}','EspecialistaController@alta')->name('especialistas.alta');
Route::Resource('especialistas','EspecialistaController');

Route::post('contratos/baja/{id}','ContratoController@alta')->name('contratos.alta');
Route::post('contratos/alta/{id}','ContratoController@baja')->name('contratos.baja');
Route::get('contratos/listarempleados','ContratoController@listarEmpleados');
Route::get('contratos/listartipos','ContratoController@listarTipos');
Route::get('contratos/listarcargos','ContratoController@listarCargos');
Route::post('contratos/guardartipo','ContratoController@guardarTipo');
Route::post('contratos/guardarcargo','ContratoController@guardarCargo');
Route::Resource('contratos','ContratoController');

Route::post('catcargos/baja/{id}','CatCargoController@baja')->name('catcargos.baja');
Route::post('catcargos/alta/{id}','CatCargoController@alta')->name('catcargos.alta');
Route::Resource('catcargos','CatCargoController');

Route::post('contratosuministros/baja{id}','ContratoSuministroController@baja')->name('contratosuministros.baja');
Route::post('contratosuministros/alta/{id}','ContratoSuministroController@alta')->name('contratosuministros.alta');
Route::Resource('contratosuministros','ContratoSuministroController');

Route::get('contratoproyectos/bajar/{archivo}','ContratoproyectoController@bajar');

Route::post('proyectos/baja/{id}','ProyectoController@baja')->name('proyectos.baja');
Route::post('proyectos/alta/{id}','ProyectoController@alta')->name('proyectos.alta');
Route::get('proyectos/listarfondos','ProyectoController@listarFondos');
Route::post('proyectos/guardarcategoria','ProyectoController@guardarCategoria');
Route::delete('proyectos/deleteMonto/{id}','ProyectoController@deleteMonto');
//rutas de las sesiones para los montos de los proyectos
Route::post('proyectos/sesion','ProyectoController@sesion');
Route::get('proyectos/getsesion','ProyectoController@getsesion');
Route::get('proyectos/limpiarsesion','ProyectoController@limpiarsesion');
//nueva forma
Route::get('proyectos/borrarlicitacion/{id}','ProyectoController@borrarlicitacion');
Route::get('proyectos/bajarlicitacion/{archivo}','ProyectoController@bajarlicitacion');
Route::get('proyectos/bajarbase/{archivo}','ProyectoController@bajarbase');
Route::get('proyectos/bajaracta/{archivo}','ProyectoController@bajar_acta');
Route::get('proyectos/calendario/{id}','ProyectoController@calendario');
Route::get('proyectos/licitaciones/{id}','ProyectoController@licitacion');
Route::post('proyectos/seleccionaroferta','ProyectoController@seleccionar_oferta');
Route::get('proyectos/portipo/{tipo}','ProyectoController@portipo');
Route::get('proyectos/poranio/{anio}','ProyectoController@poranio');
Route::put('proyectos/cambiarestado/{anio}','ProyectoController@cambiarestado');
Route::get('proyectos/informacion/{id}','ProyectoController@informacion');
Route::get('proyectos/solicitudes/{id}','ProyectoController@solicitudes');
Route::get('proyectos/contratos/{id}','ProyectoController@contratos');
Route::get('proyectos/empleados/{id}','ProyectoController@empleados');
Route::get('proyectos/pagos/{id}','ProyectoController@pagos');
Route::get('proyectos/planilla/{id}','ProyectoController@planilla');
Route::post('proyectos/subircontrato','ProyectoController@subircontrato');
Route::post('proyectos/subiroferta','ProyectoController@subiroferta');
Route::post('proyectos/subirbase','ProyectoController@subirbase');
Route::post('proyectos/subiracta','ProyectoController@subiracta');
Route::get('proyectos/elpresupuesto/{id}','ProyectoController@elpresupuesto');
Route::get('proyectos/versolicitud/{id}','ProyectoController@versolicitud');
Route::get('proyectos/formulariosoli/{id}','ProyectoController@formulariosoli');
Route::get('proyectos/generarplanilla/{id}/{idd}','ProyectoController@generar_planilla');
Route::post('proyectos/guardarplanilla','ProyectoController@guardarplanilla');
Route::post('proyectos/cambiarubicacion','ProyectoController@cambiarubicacion');
Route::post('proyectos/cambiarlicitacion','ProyectoController@cambiarlicitacion');
Route::post('proyectos/quitarempleado','ProyectoController@quitarempleado');
Route::get('proyectos/mapas','ProyectoController@mapas');
Route::get('proyectos/presupuesto_categoria/{id}/{idproy}','ProyectoController@presupuesto_categoria');
//rutas resource para proyectos
Route::Resource('proyectos','ProyectoController');
Route::Resource('jornadas','JornadaController');
Route::Resource('cargoproyectos','CargoproyectoController');

Route::Resource('indicadores','IndicadoresController');
Route::get('indicadores/segunproyecto/{id}','IndicadoresController@segunproyecto');
Route::post('indicadores/completado','IndicadoresController@completado');

Route::post('fondocats/baja/{id}','FondocatController@baja')->name('fondocats.baja');
Route::post('fondocats/alta/{id}','FondocatController@alta')->name('fondocats.alta');
Route::Resource('fondocats','FondocatController');

Route::post('tipocontratos/baja/{id}','TipocontratoController@baja')->name('tipocontratos.baja');
Route::post('tipocontratos/alta/{id}','TipocontratoController@alta')->name('tipocontratos.alta');
Route::Resource('tipocontratos','TipocontratoController');


//rutas de tesoreria
Route::get('ordencompras/pagar/{id}','OrdencompraController@pagar');

//rutas de uaci
Route::post('ordencompras/baja/{id}','OrdencompraController@baja')->name('ordencompras.baja');
Route::post('ordencompras/alta/{id}','OrdencompraController@alta')->name('ordencompras.alta');
Route::get('ordencompras/cotizaciones/{id}','OrdencompraController@getCotizacion');
Route::get('ordencompras/montos/{id}','OrdencompraController@getMonto');
Route::get('ordencompras/realizarorden/{id}','OrdencompraController@realizarorden');
Route::get('ordencompras/verificar/{id}','OrdencompraController@verificar');
Route::post('ordencompras/guardar','OrdencompraController@guardar')->name('ordencompras.guardar');
Route::get('ordencompras/requisiciones','OrdencompraController@requisiciones');
Route::get('ordencompras/create/{id}','OrdencompraController@create');
Route::get('ordencompras/modal_registrar/{id}','OrdencompraController@modal_registrar');
Route::Resource('ordencompras','OrdencompraController');

Route::get('presupuestos/crear','PresupuestoController@crear');
Route::get('presupuestos/seleccionaritem/{id}','PresupuestoController@seleccionaritem');
Route::get('presupuestos/getcategorias/{id}','PresupuestoController@getCategorias');
Route::get('presupuestos/getcatalogo/{id}/{idd}','PresupuestoController@getCatalogo');
Route::get('presupuestos/getunidades','PresupuestoController@getUnidadesMedida');
Route::post('presupuestos/cambiar','PresupuestoController@cambiar')->name('presupuestos.cambiar');
Route::post('presupuestos/guardarsesion','PresupuestoController@guardarsesion');
Route::post('presupuestos/traersesion','PresupuestoController@traersesion');
Route::Resource('presupuestos','PresupuestoController');

Route::get('presupuestodetalles/create/{id}','PresupuestoDetalleController@create');
Route::get('presupuestodetalles/getcatalogo','PresupuestoDetalleController@getCatalogo');
Route::post('presupuestodetalles/guardarsesion','PresupuestoDetalleController@guardarsesion');
Route::get('presupuestodetalles/traersesion','PresupuestoDetalleController@traersesion');
Route::delete('presupuestodetalles/eliminarsesion/{id}','PresupuestoDetalleController@eliminarsesion');
Route::get('presupuestodetalles/limpiarsesion','PresupuestoDetalleController@limpiarsesion');
Route::Resource('presupuestodetalles','PresupuestoDetalleController');

Route::get('catalogos/create','CatalogoController@create');
Route::post('catalogos/guardar','CatalogoController@guardar');
Route::Resource('catalogos','CatalogoController');
Route::post('catalogos/baja/{id}','CatalogoController@baja')->name('catalogos.baja');
Route::post('catalogos/alta/{id}','CatalogoController@alta')->name('catalogos.alta');

Route::get('categorias/create','CategoriaController@create');
Route::post('categorias/guardar','CatalogoController@guardar');
Route::Resource('categorias','CategoriaController');
Route::post('categorias/baja/{id}','CategoriaController@baja')->name('categorias.baja');
Route::post('categorias/alta/{id}','CategoriaController@alta')->name('categorias.alta');

Route::Resource('materiales','MaterialesController');
Route::get('materiales/modaleditar/{id}','MaterialesController@modaleditar');
Route::post('materiales/baja/{id}','MaterialesController@baja')->name('materiales.baja');
Route::post('materiales/alta/{id}','MaterialesController@alta')->name('materiales.alta');

//Route::get('unidadmedidas/create','UnidadMedidaController@create');
//route::post('unidadmedidas/guardar','UnidadMedidaController@guardar');
Route::Resource('unidadmedidas','UnidadMedidaController');
Route::post('unidadmedidas/baja/{id}','UnidadMedidaController@baja')->name('unidadmedidas.baja');
Route::post('unidadmedidas/alta/{id}','UnidadMedidaController@alta')->name('unidadmedidas.alta');


Route::get('cotizaciones/ver/cuadros','CotizacionController@cuadros');
Route::get('cotizaciones/ver/{id}', 'CotizacionController@cotizar');
Route::get('cotizaciones/cotizarr/{id}', 'CotizacionController@cotizarr');
Route::post('cotizaciones/seleccionar','CotizacionController@seleccionar');
Route::post('cotizaciones/seleccionarr','CotizacionController@seleccionarr');
Route::post('cotizaciones/seleccionarrr','CotizacionController@seleccionarrr');
Route::post('cotizaciones/baja/{id}','CotizacionController@baja')->name('cotizaciones.baja');
Route::post('cotizaciones/alta/{id}','CotizacionController@alta')->name('cotizaciones.alta');
Route::get('cotizaciones/realizarcotizacion/{id}','CotizacionController@realizarCotizacion');
Route::get('cotizaciones/realizarcotizacionr/{id}','CotizacionController@realizarCotizacionr');
Route::Resource('cotizaciones','CotizacionController');

Route::get('paacs/crear','PaacController@crear');
route::post('paacs/guardar','PaacController@guardar');
Route::get('paacs/exportar/{id}','PaacController@exportar');
Route::get('paacs/show2/{id}','PaacController@show2');
Route::Resource('paacs','PaacController');
Route::post('paaccategorias/baja/{id}','PaacCategoriaController@baja')->name('paaccategorias.baja');
Route::post('paaccategorias/alta/{id}','PaacCategoriaController@alta')->name('paaccategorias.alta');

Route::Resource('paaccategorias','PaacCategoriaController');
Route::Resource('paacdetalles','PaacdetalleController');

Route::Resource('detallecotizaciones','DetallecotizacionController');

Route::post('formapagos/baja/{id}','FormapagoController@baja')->name('formapagos.baja');
Route::post('formapagos/alta/{id}','FormapagoController@alta')->name('formapagos.alta');

Route::Resource('formapagos','FormapagoController');

Route::post('solicitudcotizaciones/baja/{id}','SolicitudcotizacionController@baja')->name('solicitudcotizaciones.baja');
Route::post('solicitudcotizaciones/alta/{id}','SolicitudcotizacionController@alta')->name('solicitudcotizaciones.alta');
Route::get('solicitudcotizaciones/versolicitudes/{id}','SolicitudcotizacionController@versolicitudes');
Route::get('solicitudcotizaciones/modal_cotizacion/{id}','SolicitudcotizacionController@modal_cotizacion');
Route::get('solicitudcotizaciones/getcategorias','SolicitudcotizacionController@getCategorias');
Route::get('solicitudcotizaciones/getpresupuesto','SolicitudcotizacionController@getPresupuesto');
Route::post('solicitudcotizaciones/cambiar','SolicitudcotizacionController@cambiar');
Route::get('solicitudcotizaciones/create/{id}','SolicitudcotizacionController@create');
Route::get('solicitudcotizaciones/creater/{id}','SolicitudcotizacionController@creater');
Route::post('solicitudcotizaciones/storer','SolicitudcotizacionController@storer');
Route::post('solicitudcotizaciones/storer2','SolicitudcotizacionController@storer2');
Route::Resource('solicitudcotizaciones','SolicitudcotizacionController');

/// estas son para solicitudes de bienes
Route::put('solicitudes/cambiarestado/{id}','SolicitudController@cambiarestado');
Route::get('solicitudes/solicitud/{id}','SolicitudController@solicitud');
Route::get('solicitudes/informacion/{id}','SolicitudController@informacion');
Route::get('solicitudes/formulariosoli/{id}','SolicitudController@formulariosoli');
Route::post('solicitudes/aprobar','SolicitudController@aprobar');
Route::Resource('solicitudes','SolicitudController');

Route::get('directa/modaledit/{id}','DirectaController@modal_edit');
Route::get('directa/ordencompra/{id}','DirectaController@ordencompra');
Route::post('directa/ordencompra','DirectaController@guardarorden');
Route::post('directa/subir','DirectaController@subir');
Route::post('directa/proveedor','DirectaController@proveedor');
Route::delete('directa/eliminar','DirectaController@eliminar');
Route::post('directa/eldetalle','DirectaController@eldetalle');
Route::put('directa/editardetalle/{id}','DirectaController@editardetalle');
Route::get('directa/bajar/{archivo}','DirectaController@bajar');
Route::get('directa/finalizar/{id}','DirectaController@finalizar');
Route::Resource('directa','DirectaController');

Route::Resource('contratorequisiciones','ContratoRequisicionController');
Route::get('contratorequisiciones/bajar/{archivo}','ContratoRequisicionController@bajar');

Route::get('requisiciones/enviar/{id}','RequisicionController@enviar');
Route::post('requisiciones/combinar','RequisicionController@combinar');
Route::get('requisiciones/porusuario','RequisicionController@porusuario')->name('requisiciones.porusuario');
Route::post('requisiciones/darbaja','RequisicionController@darbaja');
Route::get('requisiciones/portipo/{tipo}','RequisicionController@portipo');
Route::get('requisiciones/poranio/{anio}','RequisicionController@poranio');
Route::get('requisiciones/informacion/{id}','RequisicionController@informacion');
Route::post('requisiciones/aprobar','RequisicionController@aprobar');
Route::get('requisiciones/mostrarcontrato/{id}','RequisicionController@mostrar_contrato');
Route::post('requisiciones/subir','RequisicionController@subir');
Route::post('requisiciones/subircontrato','RequisicionController@subircontrato');
Route::get('requisiciones/bajar/{archivo}','RequisicionController@bajar');
Route::put('requisiciones/cambiarestado/{id}','RequisicionController@cambiarestado');
Route::get('requisiciones/materiales/{id}','RequisicionController@materiales');
Route::get('requisiciones/presupuesto/{id}','RequisicionController@presupuesto');
Route::post('requisiciones/modalagregar','RequisicionController@modal_agregarproducto');
Route::get('requisiciones/vercotizacion/{id}','RequisicionController@ver_cotizacion');
Route::get('requisiciones/versolicitud/{id}','RequisicionController@ver_solicitud');
Route::get('requisiciones/formulariosoli/{id}','RequisicionController@formulariosoli');
Route::Resource('requisiciones','RequisicionController');
Route::get('requisiciondetalles/create/{id}','RequisiciondetalleController@create');
Route::post('requisiciondetalles/guardar','RequisiciondetalleController@guardar');
Route::Resource('requisiciondetalles','RequisiciondetalleController');

Route::Resource('organizaciones','OrganizacionController');
Route::Resource('calendarizaciones','CalendarizacionController');
Route::get('inventarios/getmaterial/{id}','ProyectoInventarioController@getMaterial');
Route::Resource('inventarios','ProyectoInventarioController');

Route::Resource('categoriatrabajos','CategoriaTrabajoController');
Route::get('categoriatrabajos/create','CategoriaTrabajoController@create');
Route::post('categoriatrabajos/baja/{id}','CategoriaTrabajoController@baja')->name('categoriatrabajos.baja');
Route::post('categoriatrabajos/alta/{id}','CategoriaTrabajoController@alta')->name('categoriatrabajos.alta');

Route::Resource('categoriaempleados','CategoriaEmpleadoController');
Route::get('categoriaempleados/create/{id}','CategoriaEmpleadoController@create');
Route::post('categoriaempleados/baja/{id}','CategoriaEmpleadoController@baja')->name('categoriaempleados.baja');
Route::post('categoriaempleados/alta/{id}','CategoriaEmpleadoController@alta')->name('categoriaempleados.alta');
Route::get('categoriaempleados/listarempleados/{id}','CategoriaEmpleadoController@listarEmpleados');
Route::get('categoriaempleados/listarempleados/{id}','CategoriaEmpleadoController@listarEmpleados');

////////////////triburario /////////////////////////////////////////////////////////////////////////
Route::post('contribuyentes/baja/{id}','ContribuyenteController@baja')->name('contribuyentes.baja');
Route::post('contribuyentes/alta/{id}','ContribuyenteController@alta')->name('contribuyentes.alta');
Route::get('contribuyentes/pagos/{id}','ContribuyenteController@pagos');
Route::get('contribuyentes/verpagos/{id}','ContribuyenteController@verpagos');
Route::get('contribuyentes/verpagosn/{id}','ContribuyenteController@verpagosn');
Route::post('contribuyentes/generarpagos','ContribuyenteController@generarPagosContribuyente');
Route::post('verpagosgenerados','ContribuyenteController@verPagosGenerados')->name('verpagosgenerados');
Route::post('verpagosnegociosgenerados','ContribuyenteController@verPagosNegociosGenerados')->name('verpagosnegociosgenerados');
Route::post('verfacturaspendientes','ContribuyenteController@verFacturasPendientes')->name('verfacturaspendientes');
Route::get('verfacturaspendientes','ContribuyenteController@verFacturasPendientes')->name('verfacturaspendientes');
Route::get('verfacturaspendientesn','ContribuyenteController@verFacturasPendientesn')->name('verfacturaspendientesn');
Route::get('contribuyentes/solvencia/{id}','ContribuyenteController@solvencia')->name('solvencia');
Route::get('contribuyentes/pdfsolvencia/{id}','ContribuyenteController@pdfsolvencia')->name('solvencia');

/*Route::get('contribuyentes/eliminados','ContribuyenteController@eliminados');*/
Route::get('contribuyentes/recibosn/{id}','ContribuyenteController@recibosn');
Route::Resource('contribuyentes','ContribuyenteController');
Route::get('contribuyentes-morosos','ContribuyenteController@morosos');

Route::post('perpetuidad/beneficiario','PerpetuidadController@beneficiario');
Route::get('perpetuidad/recibos','PerpetuidadController@recibos');
Route::post('perpetuidad/cobro','PerpetuidadController@cobro');
Route::Resource('perpetuidad','PerpetuidadController');

Route::Resource('tiposervicios','TipoServicioController');
Route::post('tiposervicios/baja/{id}','TipoServicioController@baja')->name('tiposervicios.baja');
Route::post('tiposervicios/alta/{id}','TipoServicioController@alta')->name('tiposervicios.alta');
/*Route::post('impuestos/baja/{id}','impuestoController@baja')->name('impuestos.baja');
Route::post('impuestos/alta/{id}','ImpuestoController@alta')->name('impuestos.alta');
Route::Resource('impuestos','ImpuestoController');*/


Route::Resource('rubros','RubroController');
Route::post('rubros/baja/{id}','RubroController@baja')->name('rubros.baja');
Route::post('rubros/alta/{id}','RubroController@alta')->name('rubros.alta');

Route::post('negocios/ubicacion','NegocioController@ubicacion');
Route::Resource('negocios','NegocioController');
Route::post('alumbrado/reparar','AlumbradoController@reparar');
Route::get('alumbrado/reparadas','AlumbradoController@reparadas');
Route::Resource('alumbrado','AlumbradoController');
Route::get('reportar-alumbrado','ReportePublicoController@yo_reporto');
Route::post('guardar-alumbrado','ReportePublicoController@store');

Route::post('inmuebles/guardar','InmuebleController@guardar')->name('inmuebles.guardar');
Route::post('inmuebles/quitarimpuesto', 'InmuebleController@quitarservicioinmueble'); //funcion para quitar impuesto
Route::post('inmuebles/agregarimpuesto', 'InmuebleController@addTipoServicioInmueble'); //funcion para agregar impuesto
Route::get('inmuebles/impuestos/{id}','InmuebleController@impuestos_inmueble');
Route::get('inmuebles/buscarinmuebles','InmuebleController@buscarInmueble');
Route::get('inmuebles/buscarfacturas','InmuebleController@buscarFactura');
Route::post('inmuebles/ubicacion','InmuebleController@ubicacion');

/*Route::post('inmuebles/alta/{id}','InmuebleController@alta')->name('inmuebles.alta');*/
Route::Resource('inmueble','InmuebleController');

Route::post('construcciones/cobro','ConstruccionController@cobro');
Route::get('construcciones/inmuebles/{id}','ConstruccionController@inmueble');
Route::put('construcciones/cambiarestado/{id}','ConstruccionController@cambiarestado');
Route::get('construcciones/recibos','ConstruccionController@recibo');
Route::post('construcciones/baja/{id}','ConstruccionController@baja')->name('construcciones.baja');
Route::Resource('construcciones','ConstruccionController');

////////// Tesoreria //////////////////////////////////
Route::post('empleados/baja/{id}','EmpleadoController@baja')->name('empleados.baja');
Route::post('empleados/alta/{id}','EmpleadoController@alta')->name('empleados.alta');
Route::Resource('empleados','EmpleadoController');
Route::get('empleados/selectcargos/{id}','EmpleadoController@selectcargo');
Route::post('empleados/bancarios','EmpleadoController@ebancos');
Route::post('empleados/afps','EmpleadoController@afps');
Route::post('empleados/isss','EmpleadoController@isss');
Route::post('empleados/usuarios','EmpleadoController@usuarios');
Route::post('empleados/eusuarios','EmpleadoController@eusuarios');
Route::post('empleados/ebancos','EmpleadoController@ebancos');
Route::post('empleados/foto/{id}','EmpleadoController@foto');
Route::get('empleados/perfil/{id}','EmpleadoController@perfil');

Route::get('afps/get','AfpController@get');
Route::Resource('afps','AfpController');
Route::post('afps/baja/{id}','AfpController@baja')->name('afps.baja');
Route::post('afps/alta/{id}','AfpController@alta')->name('afps.alta');

Route::get('servicios/pagos','ServiciosController@pagos')->name("servicios.pagos");
Route::delete('servicios/restaurar/{id}','ServiciosController@restaurar');
Route::post('servicios/pagar','ServiciosController@pagar_servicio');
Route::Resource('servicios','ServiciosController');

Route::Resource('retenciones','RetencionController');

Route::post('partidas/pago','PartidaController@pago');
Route::Resource('partidas','PartidaController');

Route::post('eventuales/pagar','EventualController@pagar');
Route::post('planillas/pagar','PlanillaController@pagar');
Route::Resource('planillas','PlanillaController');
Route::Resource('eventuales','EventualController');
Route::get('planillaproyectos/cambiarestado/{id}','PeriodoProyectoController@cambiarestado');
Route::get('planillaproyectos/desembolso/{id}','PeriodoProyectoController@desembolso');
Route::Resource('planillaproyectos','PeriodoProyectoController');

Route::get('pagocuentas/{id}','PagocuentaController@index')->name("pagocuentas.index");

Route::Resource('pagorentas','PagoRentaController');

Route::Resource('prestamos','PrestamoController');
Route::Resource('descuentos','DescuentoController');

Route::post('prestamotipos/baja/{id}','PrestamotiposController@baja')->name('prestamotipos.baja');
Route::Resource('prestamotipos','PrestamotiposController');

Route::get('cargos/get','CargoController@get');
Route::Resource('cargos','CargoController');
Route::post('cargos/baja/{id}','CargoController@baja')->name('cargos.baja');
Route::post('cargos/alta/{id}','CargoController@alta')->name('cargos.alta');

Route::get('cuentas/get','CuentaController@get');
Route::get('cuentas/proyectos','CuentaController@proyectos');
Route::put('cuentas/editarproyectos/{id}','CuentaController@editarproyectos');
Route::get('cuentas/movimientos/{id}','CuentaController@show2');
Route::get('cuentas/modalasignar/{id}/{tipo}','CuentaController@modal_asignar');
Route::get('cuentas/modalremesar/{id}/{tipo}','CuentaController@modal_remesar');
Route::post('cuentas/abonarcuenta','CuentaController@abonarcuenta');
Route::post('cuentas/abonarproyecto','CuentaController@abonarproyecto');
Route::post('cuentas/remesarcuenta','CuentaController@remesarcuenta');
Route::post('cuentas/remesarproyecto','CuentaController@remesarproyecto');
Route::Resource('cuentas','CuentaController');

//Route::Resource('cuentaprincipal','CuentaprincipalController');
Route::post('cuentas/baja/{id}','CuentaController@baja')->name('cuentas.baja');
//Route::post('cuentas/alta/{id}','CuentaController@alta')->name('cuentas.alta');

Route::Resource('desembolsos','DesembolsoController');
Route::post('ingresos/cobro','IngresoController@cobro');
Route::post('ingresos/otro','IngresoController@otro');
Route::Resource('ingresos','IngresoController');
Route::Resource('tipopagos','TipopagoController');
Route::get('pagos/ordencompras','OrdencompraController@index2');
Route::Resource('pagos','PagoController');
Route::Resource('cobros','CobroController');
Route::Resource('tipopagos', 'TipopagoController');

//Rutas de Reportes UACI
Route::get('reportesuaci/proyectos','ReportesUaciController@proyectos');
Route::get('reportesuaci/proveedores','ReportesUaciController@proveedor');
Route::get('reportesuaci/solicitud/{id}','ReportesUaciController@solicitud');
Route::get('reportesuaci/ordencompra/{id}','ReportesUaciController@ordencompra');
Route::get('reportesuaci/cuadrocomparativo/{id}','ReportesUaciController@cuadrocomparativo');
Route::get('reportesuaci/contratoproyecto/{id}','ReportesUaciController@contratoproyecto');
Route::get('reportesuaci/requisicionobra/{id}','ReportesUaciController@requisicionobra');
Route::get('reportesuaci/ordencompra2/{id}','ReportesUaciController@ordencompra2');
Route::get('reportesuaci/acta/{id}','ReportesUaciController@acta');
Route::get('reportesuaci/cotizaciones/{id}','ReportesUaciController@cotizaciones');
Route::get('reportesuaci/presupuestounidad/{id}','ReportesUaciController@presupuestounidad');
Route::get('reportesuaci/planillaproyecto/{id}','ReportesUaciController@planillaproyecto');
Route::get('reportesuaci/asistenciaproyecto/{id}','ReportesUaciController@asistenciaproyecto');
//Reportes Tesoreria
Route::get('reportestesoreria/pagos/{id}','ReportesTesoreriaController@pagos');///////////REVISAR
Route::get('reportestesoreria/planillas/{id}','ReportesTesoreriaController@planillas');
Route::get('reportestesoreria/eventuales/{id}','ReportesTesoreriaController@planillas2');
Route::get('reportestesoreria/planillaaprobada/{id}','ReportesTesoreriaController@planillaaprobada');
Route::get('reportestesoreria/boleta/{id}','ReportesTesoreriaController@boleta');
Route::get('reportestesoreria/boletageneral/{id}','ReportesTesoreriaController@boletageneral');
Route::get('reportestesoreria/pagorenta/{id}','ReportesTesoreriaController@pagorentas');
Route::get('reportestesoreria/reciboc/{id}','ReportesTesoreriaController@reciboc');
Route::get('reportestesoreria/recibop/{id}','ReportesTesoreriaController@recibop');
Route::get('reportestesoreria/partida/{id}','ReportesTesoreriaController@partida');
//Ruta para detalle de planillas
Route::post('detalleplanillas/store2','DetallePlanillaController@store2');
Route::Resource('detalleplanillas','DetalleplanillaController');
Route::Resource('bancos','BancoController');
Route::post('bancos/baja/{id}','BancoController@baja')->name('bancos.baja');
Route::post('bancos/alta/{id}','BancoController@alta')->name('bancos.alta');
Route::Resource('vacaciones','VacacionController');
Route::post('vacaciones/fecha','VacacionController@fecha');
//Rutas R
Route::get('categoria/listar','SolicitudcotizacionController@categorias_ne')->name('categoria.listar');

Route::post('save-comment','HomeController@saveComment');








































Route::post('unidades/baja/{id}','UnidadAdminController@baja')->name('bancos.baja');
Route::post('unidades/alta/{id}','UnidadAdminController@alta')->name('bancos.alta');
Route::Resource('unidades','UnidadAdminController');
Route::get('presupuestounidades/materiales/{id}','PresupuestoUnidadController@materiales');
Route::get('presupuestounidades/anio/{anio}','PresupuestoUnidadController@anio');
Route::post('presupuestounidades/cambiar/{id}','PresupuestoUnidadController@cambiar');
Route::get('presupuestounidades/clonar/{id}','PresupuestoUnidadController@clonar');
Route::get('presupuestounidades/porunidad','PresupuestoUnidadController@porunidad')->name('presupuestounidades.porunidad');
Route::Resource('presupuestounidades','PresupuestoUnidadController');
Route::Resource('presupuestounidaddetalles','PresupuestoUnidadDetalleController');

/**
 * Rutas para el mapa
*/
Route::get('negocio/mapa/{id}', 'NegocioController@viewMapa');
Route::post('negocio/mapa/create', 'NegocioController@mapas');
Route::get('mapa', 'NegocioController@mapa');
Route::post('mapa/all', 'NegocioController@mapasAll');
Route::get('reporte', 'ReportesUaciController@reportePDF');

// Routas para el cementerio
Route::post('cementerios/baja/{id}','CementerioController@baja')->name('cementerios.baja');
Route::post('cementerios/alta/{id}','CementerioController@alta')->name('cementerios.alta');
Route::Resource("/cementerios", "CementerioController");


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
