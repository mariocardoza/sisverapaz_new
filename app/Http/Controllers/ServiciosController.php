<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\ServiciosPago;
use App\Cuenta;
use App\CuentaDetalle;
use DB;
use Validator;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $estado="";
        $estado=$r->estado;
        if($estado=="") $estado=1;
        $servicios=Servicio::whereEstado($estado)->get();
        return view('servicios.index', compact('servicios','estado'));
    }

    public function pagos()
    {
        $pagados=ServiciosPago::all();

        return view('servicios.pagos',compact('pagados'));
    }

    public function pagar_servicio(Request $request)
    {
        $this->validar_pago($request->all())->validate();
        try{
            DB::beginTransaction();
            $elpago=ServiciosPago::create([
                'id'=>date("Yidisus"),
                'cuenta_id'=>$request->cuenta_id,
                'servicio_id'=>$request->servicio_id,
                'monto'=>$request->monto,
                'fecha_pago'=>invertir_fecha($request->fecha_pago),
                'anio'=>$request->anio,
                'mes'=>$request->mes
            ]);
            $servi=Servicio::find($request->servicio_id);

            $cuenta_origen=Cuenta::find($request->cuenta_id);
            $monto_origen=$cuenta_origen->monto_inicial;
            $cuenta_origen->monto_inicial=$monto_origen-$request->monto;
            $cuenta_origen->save();

            $detalle_destino=CuentaDetalle::create([
                'id'=>CuentaDetalle::retonrar_id_insertar(),
                'cuenta_id'=>$cuenta_origen->id,
                'accion'=>'Se pago la cantidad de $'.$request->monto.' correspondiente al pago del servicio: '.$servi->nombre.' del mes de '.$request->mes,
                'tipo'=>1,
                'monto'=>$request->monto
            ]);
            DB::commit();
            return array(1,"exito");
        }catch(Exception $e){
            DB::rollback();
            return array(-1,"error",$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validar($request->all())->validate();
        try{
            Servicio::create($request->all());
            return array(1,"exito");
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    protected function validar(array $data)
    {
        $mensajes=array(
            'nombre.required'=>'El nombre del servicio es obligatorio',
            'fecha_contrato.required'=>'La fecha de contratación es obligatoria'
        );
        return Validator::make($data, [
            'nombre' => 'required',
            'fecha_contrato' => 'required',
        ],$mensajes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $s=Servicio::findorFail($id);
        return array(1,$s,$s->fecha_contrato->format("d-m-Y"));
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
        $this->validar($request->all())->validate();
        try{
            $s=Servicio::findorFail($id);
            $s->nombre=$request->nombre;
            $s->fecha_contrato=\invertir_fecha($request->fecha_contrato);
            $s->save();
            return array(1,"exito");
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $s=Servicio::findorFail($id);
            $s->estado=2;
            $s->save();
            return array(1);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    public function restaurar($id)
    {
        try{
            $s=Servicio::findorFail($id);
            $s->estado=1;
            $s->save();
            return array(1);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    protected function validar_pago(array $data)
    {
        $mensajes=array(
            'cuenta_id.required'=>'Seleccione una cuenta',
            'servicio_id.required'=>'Seleccione una servicio a pagar',
            'monto.required'=>'El monto es obligatorio',
            'anio.required'=>'El año es obligatorio',
            'fecha_pago.required'=>'La fecha de pago es obligatorio',
        );
        return Validator::make($data, [
            'cuenta_id' => 'required',
            'servicio_id' => 'required',
            'monto' => 'required|numeric|min:0.01',
            'anio' => 'required',
            'fecha_pago' => 'required',
        ],$mensajes);

        
    }
}
