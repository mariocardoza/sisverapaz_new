<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Retencion;
use App\Contrato;
use App\Cuenta;
use App\CuentaDetalle;
use App\Planilla;
use App\Detalleplanilla;
use App\PagoRenta;
use App\Datoplanilla;
use DB;
use Carbon\Carbon;
use App\Prestamo;

class PlanillaController extends Controller
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

     public function pagar(Request $request)
     {
        $this->validar_pago($request->all())->validate();
         $total=Datoplanilla::totalplanilla($request->id);
         $cuenta=Cuenta::find($request->cuenta_id);
         if($total>$cuenta->monto_inicial){
            return array(2,"exito","El total de la planilla supera a lo disponible en la cuenta");
         }else{
            try{
                DB::beginTransaction();
                $planilla=Datoplanilla::find($request->id);
                $cuenta->monto_inicial=$cuenta->monto_inicial-$total;
                $cuenta->save();
                CuentaDetalle::create([
                    'id'=>CuentaDetalle::retonrar_id_insertar(),
                    'cuenta_id'=>$cuenta->id,
                    'accion'=>'Pago de salarios al mes de '.obtenerMes($planilla->mes).' de '.$planilla->anio,
                    'tipo'=>2,
                    'monto'=>$total,
                ]);
                $planilla->estado=4;
                $planilla->save();
                foreach($planilla->planilla as $planilla){
                    if($planilla->renta>0){
                        $renta= new PagoRenta();
                        $renta->nombre = $planilla->empleado->nombre;
                        $renta->dui = $planilla->empleado->dui;
                        $renta->nit = $planilla->empleado->nit;
                        $renta->total = $planilla->empleado->detalleplanilla->salario;
                        $renta->renta = $planilla->renta;
                        $renta->liquido = $renta->total-$planilla->renta;
                        $renta->concepto = 'Pago de salario correspondiente a:'.$planilla->datoplanilla->mes.'/'.$planilla->datoplanilla->anio;
                        $renta->save();
                    }
                }
                DB::commit();
                return array(1,"exito",$total);
            }catch(Exception $e){
                DB::rollback();
                return array(-1,"error",$e->getMessage());
            }
         }
         
     }

    public function index(Request $request)
    {
        $anios=DB::table('datoplanillas')->distinct()->get(['anio']);
        $elanio="";
        if($request->get('anio') == ""){
            $elanio=date("Y");
        }else{
            $elanio=$request->get('anio');
        } 
        $planillas = Datoplanilla::where('anio',$elanio)->where('tipo_planilla',1)->orderBy('created_at',"desc")->orderBy('estado',"asc")->get();
        return view('planillas.index',compact('planillas','anios','elanio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mes = date('m');
        $year = date('Y');
        // $empleados = Contrato::all();
        // $retencion = Retencion::first();
        $retenciones = Retencion::all();
        $empleados= Detalleplanilla::empleadosPlanilla();
   
        return view('planillas.create',compact('mes','year','empleados','retenciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe=Datoplanilla::whereMonth('fecha',date('m'))->whereIn('estado',[1,3,4])->where('tipo_Planilla',1)->count();
        if($existe==0){
            $retenciones = Retencion::all();
            $count = count($request->empleado_id);
            try {
                DB::beginTransaction();
                $datoplanilla=Datoplanilla::create([
                    'fecha'=>\Carbon\Carbon::now(),
                    'tipo_pago'=>$request->tipo,
                    'mes'=>$request->mes,
                    'anio'=>$request->anio
                ]);
                for($i=0;$i<$count;$i++){
                    if($request->prestamos[$i]=='0'){
                        $p=null;
                    }else{
                        $p=$request->prestamos[$i];
                    }
                    if($request->descuentos[$i]=='0'){
                        $d=null;
                    }else{
                        $d=$request->descuentos[$i];
                    }
                    Planilla::create([
                        'empleado_id'=>$request->empleado_id[$i],
                        'salario'=>$request->salario[$i],
                        'issse'=>$request->ISSSE[$i],
                        'afpe'=>$request->AFPE[$i],
                        'isssp'=>$request->ISSSP[$i],
                        'afpp'=>$request->AFPP[$i],
                        'insaforpp'=>$request->INSAFORPP[$i],
                        'estado'=>0,
                        'datoplanilla_id'=>$datoplanilla->id,
                        'prestamos'=>$p,
                        'descuentos'=>$d,
                        'renta'=>$request->renta[$i],
                    ]);
                }
                //Prestamo::actualizar();
                DB::commit();
                return redirect('/planillas')->with('mensaje', 'Planilla registrada exitosamente');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('planillas')->with('error','Ocurri?? un error, contacte al administrador');
            }
        }else{
            if($existe == 1 && $request->tipo==2 && (date("d")>=25)){
                $retenciones = Retencion::all();
                $count = count($request->empleado_id);
                try {
                    DB::beginTransaction();
                    $datoplanilla=Datoplanilla::create([
                        'fecha'=>\Carbon\Carbon::now(),
                        'tipo_pago'=>$request->tipo,
                        'mes'=>$request->mes,
                        'anio'=>$request->anio
                    ]);
                    for($i=0;$i<$count;$i++){
                        if($request->prestamos[$i]=='0'){
                            $p=null;
                        }else{
                            $p=$request->prestamos[$i];
                        }
                        if($request->descuentos[$i]=='0'){
                            $d=null;
                        }else{
                            $d=$request->descuentos[$i];
                        }
                        Planilla::create([
                            'empleado_id'=>$request->empleado_id[$i],
                            'salario'=>$request->salario[$i],
                            'issse'=>$request->ISSSE[$i],
                            'afpe'=>$request->AFPE[$i],
                            'isssp'=>$request->ISSSP[$i],
                            'afpp'=>$request->AFPP[$i],
                            'insaforpp'=>$request->INSAFORPP[$i],
                            'estado'=>0,
                            'datoplanilla_id'=>$datoplanilla->id,
                            'prestamos'=>$p,
                            'descuentos'=>$d,
                            'renta'=>$request->renta[$i],
                        ]);
                    }
                    //Prestamo::actualizar();
                    DB::commit();
                    return redirect('/planillas')->with('mensaje', 'Planilla registrada exitosamente');
                }catch (\Exception $e) {
                    DB::rollback();
                    return redirect('planillas')->with('error','Ocurri?? un error, contacte al administrador');
                }
            }else{
                    return redirect('planillas')->with('error','Ya registr?? la planilla correspondiente a este mes de '.Datoplanilla::obtenerMes(date('m')).' del a??o '.date("Y"). ' Podr?? registrar una nueva planilla el pr??ximo mes a partir del dia 25');
            }
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datoplanilla=Datoplanilla::find($id);
        $planillas=Planilla::where('datoplanilla_id',$id)->get();
        return view('planillas.show',compact('planillas','datoplanilla'));
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
        try{
            $planilla=Datoplanilla::find($id);
            $planilla->estado=3;
            $planilla->save();
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
    public function destroy(Request $request,$id)
    {
        try{
            $planilla=Datoplanilla::find($id);
            $planilla->estado=2;
            $planilla->motivo=$request->motivo;
            $planilla->save();
            return array(1,"exito",$request->all());
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    protected function validar_pago(array $data)
    {
        $mensajes=array(
            'cuenta_id.required'=>'Debe seleccionar una cuenta',
        );
        return \Validator::make($data, [
            'cuenta_id'=>'required'
        ],$mensajes);

        
    }
}
