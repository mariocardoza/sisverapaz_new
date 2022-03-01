<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\Detallecotizacion;
use App\Proyecto;
use App\Fondo;
use App\Cuenta;
use App\CuentaDetalle;
use App\Ordencompra;
use App\Presupuesto;
use App\PresupuestoSolicitud;
use App\Solicitudcotizacion;
use App\ProyectoInventario;
use App\Proveedor;
use App\Requisicione;
use App\Requisiciondetalle;
use App\SolicitudRequisicion;
use App\Desembolso;
use Illuminate\Http\Request;
use App\Http\Requests\OrdenCompraRequest;
use DB;
use App\Formapago;


class OrdencompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

     public function getCotizacion($id)
     {
        $proyecto=Proyecto::findorFail($id);
        $presupuesto=Presupuesto::where('proyecto_id',$proyecto->id)->first();
        $soli=PresupuestoSolicitud::where('presupuesto_id',$presupuesto->id)->first();
        return Cotizacion::where('presupuestosolicitud_id',$soli->id)->where('seleccionado',true)->where('estado',2)->with('proveedor','detallecotizacion')->orderby('id','asc')->get();
     }

     public function getMonto($id)
     {
        return Fondo::where('proyecto_id',$id)->with('fondocat')->get();
     }

     public function requisiciones(Request $request)
     {
       return Requisiciondetalle::where('requisicion_id',$request->idrequisicion)->get();
     }

     public function realizarorden($id)
     {
       $solicitud=Solicitudcotizacion::findorFail($id);
      // $presupuesto=Presupuesto::findorFail($solicitud->presupuesto->id);
       $cotizacion=Cotizacion::where('solicitudcotizacion_id',$solicitud->id)->where('seleccionado',true)->where('estado',2)->with('detallecotizacion')->firstorFail();
       return view('ordencompras.create',compact('cotizacion'));
     }

     public function verificar($id)
     {
       $orden=Ordencompra::where('estado',1)->findorFail($id);
       $cotizacion=Cotizacion::findorFail($orden->cotizacion->id);
       $detalles=Detallecotizacion::where('cotizacion_id',$cotizacion->id)->get();
       //dd($cotizacion->presupuestosolicitud->presupuesto->proyecto->id);
       DB::beginTransaction();
       try{
         foreach ($detalles as $detalle) {
           ProyectoInventario::create([
             'descripcion' => $detalle['descripcion'],
             'cantidad' => $detalle['cantidad'],
             'proyecto_id' => $cotizacion->presupuestosolicitud->presupuesto->proyecto->id,
           ]);
         }

         $solicitud=PresupuestoSolicitud::findorFail($cotizacion->presupuestosolicitud->id);
         $solicitud->estado=5;
         $solicitud->save();

         $orden->estado=3;
         $orden->save();

         $presupuesto=Presupuesto::where('proyecto_id',$cotizacion->presupuestosolicitud->presupuesto->proyecto->id)->get();
         foreach($presupuesto as $presu){
           $soli=PresupuestoSolicitud::where('estado',4)->where('presupuesto_id',$presu->id)->count();
         }
         if($soli==0){
           $proyecto=Proyecto::findorFail($cotizacion->presupuestosolicitud->presupuesto->proyecto->id);
           $proyecto->estado=8;
           $proyecto->save();
           DB::commit();
           return redirect('proyectos')->with('mensaje','Materiales recibidos correctamente');
         }
         DB::commit();
         return redirect('ordencompras')->with('mensaje','Materiales recibidos correctamente');


       }catch(\Exception $e){
         DB::rollback();
         return redirect('ordencompras')->with('error','Ocurrió un error consulte al administrador');
       }
     }

    public function guardar(Request $request)
    {
      dd($request->all());
    }

    public function index(Request $request)
    {
      //dd(Ordencompra::correlativo());
      $estado = $request->get('estado');
      if( $estado == "" )
      {
        $ordenes = Ordencompra::orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 1 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 2 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }
      if( $estado == 3 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index',compact('ordenes','estado'));
      }

    }

    public function index2(Request $request)
    {
      $estado = $request->get('estado');
      if( $estado == "" )
      {
        $ordenes = Ordencompra::orderBy('numero_orden')->get();
        return view('ordencompras.index2',compact('ordenes','estado'));
      }
      if( $estado == 1 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index2',compact('ordenes','estado'));
      }
      if( $estado == 2 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index2',compact('ordenes','estado'));
      }
      if( $estado == 3 )
      {
        $ordenes = Ordencompra::where('estado',$estado)->orderBy('numero_orden')->get();
        return view('ordencompras.index2',compact('ordenes','estado'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $requisicion = Requisicione::findorFail($id);
        $cotizacion=Cotizacion::where('solicitudcotizacion_id',$requisicion->solicitudcotizacion->id)->where('seleccionado',true)->firstorFail();
        //dd($cotizacion->detallecotizacion);
        return view('ordencompras.guardar',compact('cotizacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdenCompraRequest $request)
    {
        //dd($request->All());
        if($request->ajax())
        {
          DB::beginTransaction();
          try{
           $orden = Ordencompra::create([
                'numero_orden' => Ordencompra::correlativo(),
                'fecha_inicio' => invertir_fecha($request->fecha_inicio),
                'fecha_fin' => invertir_fecha($request->fecha_fin),
                'cotizacion_id' => $request->cotizacion_id,
                'observaciones' => $request->observaciones == "" ? 'ninguna' : $request->observaciones,
                'direccion_entrega' => $request->direccion_entrega,
                'adminorden' => $request->adminorden,
            ]);
            $cotizacion = Cotizacion::findorFail($request->cotizacion_id);
            $cotizacion->estado=3;
            $cotizacion->save();

            if($cotizacion->solicitudcotizacion->tipo==1)
            {
              $proyecto=Proyecto::findorFail($cotizacion->solicitudcotizacion->proyecto->id);
              $proyecto->estado=7;
              $proyecto->save();

              $desembolso=Desembolso::create([
                'id'=>date("Yidisus"),
                'monto'=>\App\Detallecotizacion::total_cotizacion($cotizacion->id),
                'renta'=>\App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                'detalle'=>'Orden de compra n°:'.$orden->numero_orden.' para proyecto: '.$cotizacion->solicitudcotizacion->proyecto->nombre,
                'cuentaproy_id'=>$cotizacion->solicitudcotizacion->proyecto->cuentaproy->id
              ]);

              //REGISTRO DEL PAGO DE LA RENTA

              $tienerenta = Detallecotizacion::renta_cotizacion($cotizacion->id);
              if($tienerenta>0):
                $pagorenta = \App\PagoRenta::create([
                  'nombre'=> $orden->cotizacion->proveedor->nombre,
                  'dui'=> $orden->cotizacion->proveedor->dui,
                  'nit'=> $orden->cotizacion->proveedor->nit,
                  'total' => \App\Detallecotizacion::total_cotizacion($cotizacion->id),
                  'renta' => \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'liquido' => \App\Detallecotizacion::total_cotizacion($cotizacion->id)- \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'concepto' => 'Pago de renta de Orden de Compra',
                  'desembolso_id'=>$desembolso->id
                ]);
              endif;

              DB::commit();
              
              return array(1,"exito",$cotizacion->solicitudcotizacion->id);
            }elseif($cotizacion->solicitudcotizacion->tipo==2){
              $requisicion=Requisicione::findorFail($cotizacion->solicitudcotizacion->requisicion->id);
              if(!Requisicione::tiene_materiales($cotizacion->solicitudcotizacion->requisicion->id)):
                $requisicion->estado=5;
              endif;
              $requisicion->save();

              $desembolso=Desembolso::create([
                'monto'=>\App\Detallecotizacion::total_cotizacion($cotizacion->id),
                'renta'=>\App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                'detalle'=>'Orden de compra n°:'.$orden->numero_orden.' para actividad: '.$cotizacion->solicitudcotizacion->requisicion->actividad,
                'cuenta_id'=>$cotizacion->solicitudcotizacion->requisicion->cuenta->id,
                'payment_table_id' => $orden->id,
                'table'=>class_basename($orden),
              ]);

              $tienerenta = Detallecotizacion::renta_cotizacion($cotizacion->id);
              if($tienerenta>0):
                $pagorenta = \App\PagoRenta::create([
                  'nombre'=> $orden->cotizacion->proveedor->nombre,
                  'dui'=> $orden->cotizacion->proveedor->dui,
                  'nit'=> $orden->cotizacion->proveedor->nit,
                  'total' => \App\Detallecotizacion::total_cotizacion($cotizacion->id),
                  'renta' => \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'liquido' => \App\Detallecotizacion::total_cotizacion($cotizacion->id)- \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'concepto' => 'Pago de renta de Orden de Compra',
                ]);
              endif;

              DB::commit();
              return array(1,"exito",$cotizacion->solicitudcotizacion->id);
            }else{
              $requisicion=SolicitudRequisicion::findorFail($cotizacion->solicitudcotizacion->solirequi_id);
              $requisicion->estado=5;
              $requisicion->save();

              $desembolso=Desembolso::create([
                'monto'=>\App\Detallecotizacion::total_cotizacion($cotizacion->id),
                'renta'=>\App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                'detalle'=>'Orden de compra n°:'.$orden->numero_orden.' para actividad: Compra de bienen y servicios',
                'cuenta_id'=>$cotizacion->solicitudcotizacion->solirequi->cuenta->id,
                'payment_table_id' => $orden->id,
                'table'=>class_basename($orden),
              ]);

              $tienerenta = Detallecotizacion::renta_cotizacion($cotizacion->id);
              if($tienerenta>0):
                $pagorenta = \App\PagoRenta::create([
                  'nombre'=> $orden->cotizacion->proveedor->nombre,
                  'dui'=> $orden->cotizacion->proveedor->dui,
                  'nit'=> $orden->cotizacion->proveedor->nit,
                  'total' => \App\Detallecotizacion::total_cotizacion($cotizacion->id),
                  'renta' => \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'liquido' => \App\Detallecotizacion::total_cotizacion($cotizacion->id)- \App\Detallecotizacion::renta_cotizacion($cotizacion->id),
                  'concepto' => 'Pago de renta de Orden de Compra',
                ]);
              endif;

              DB::commit();
              return array(1,"exito",$cotizacion->solicitudcotizacion->id);
            }

            //return redirect('solicitudcotizaciones/versolicitudes/'.$cotizacion->presupuestosolicitud->presupuesto->proyecto->id)->with('mensaje','Orden de compra registrada con éxito');
          }catch(\Excention $e){
            DB::rollback();
            return response()->json([
              'mensaje' => 'error',
              'error' => $e->getMessage()
            ]);
          //  return redirect('ordencompras/create')->with('error','ocurrió un error al guardar la orden de compras');
          }
        }
    }

    public function pagar($id)
    {
      $orden = Ordencompra::find($id);
      $orden->estado=4;
      $orden->save();
      $detas = $orden->cotizacion->detallecotizacion;
      $total=0;
      foreach($detas as $deta){
        $total+=$deta->precio_unitario*$deta->cantidad;
      }
      $cuenta_origen=Cuenta::find($orden->cotizacion->solicitudcotizacion->requisicion->cuenta->id);
            $monto_origen=$cuenta_origen->monto_inicial;
            $cuenta_origen->monto_inicial=$monto_origen-$total;
            $cuenta_origen->save();

            $detalle_destino=CuentaDetalle::create([
                'id'=>CuentaDetalle::retonrar_id_insertar(),
                'cuenta_id'=>$cuenta_origen->id,
                'accion'=>'Se pago la cantidad de $'.$total.' correspondiente al pago de la orden de compra: '.$orden->numero_orden.' para la requisición: '.$orden->cotizacion->solicitudcotizacion->requisicion->actividad,
                'tipo'=>1,
                'monto'=>$total
            ]);
      return array(1,$cuenta_origen,$total);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = Ordencompra::findorFail($id);
        return view('ordencompras.show',compact('orden'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try{
          $orden=Ordencompra::find($id);
          if($request->tipo==1):
            $coti=Cotizacion::find($request->coti);
          elseif($request->tipo==2):
            $coti=Cotizacion::find($request->coti);
          else:
            $coti=Cotizacion::find($request->coti);
          endif;
          return array($coti);
        }catch(Exception $e){
          return array(-1,"error",$e->getMessage());
        }
    }

    public function modal_registrar($id)
    {
      $retorno=Ordencompra::modal_registrar($id);
      return $retorno;
    }
}
