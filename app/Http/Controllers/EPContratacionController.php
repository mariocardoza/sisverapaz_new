<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContratoProyecto;
use App\ContratacionProyecto;
use App\EPFuncione;
use DB;

class EPContratacionController extends Controller
{
    /*obtener el listado de empleados que no esten trabajando en otro proyecto de la alcaldía

    */
    public function listadeempleados($id)
    {
      $empleados = DB::table('empleados')
                ->whereNotExists(function ($query) use ($id) {
                     $query->from('contratacion_proyectos')
                        ->whereRaw('contratacion_proyectos.empleado_id = empleados.id')
                        ->whereRaw('contratacion_proyectos.contratoproyecto_id = '.$id);
                    })->get();
      return base64_encode($empleados);
    }

    /*
    se listan todos las contrataciones en consulta ajax
    */
    public function todosloscontratos()
    {
      return base64_encode(ContratacionProyecto::with('empleado','contratoproyecto')->get());
    }

    //ver la informacion relevante de la persona contratada

    public function vercontratado($id)
    {
      return base64_encode($contratado = ContratacionProyecto::with('empleado','ContratoProyecto','epfuncione')->find($id));
      /*return $contratacion = DB::table('contratacion_proyectos AS cps')
            ->with('epfuncione')
            ->select('emp.nombre AS nomemp','pro.nombre AS nompro','pro.direccion')
            ->join('empleados as emp', 'cps.empleado_id', '=', 'emp.id')
            ->join('contrato_proyectos AS cp', 'cps.contratoproyecto_id', '=','cp.id')
            ->join('proyectos AS pro','cp.proyecto_id','=','pro.id')
            ->where('cps.id', $id)
            ->get();*/
      //return $e = select * from contratacion_proyectos INNER JOIN empleados INNER JOIN contrato_proyectos INNER JOIN proyectos WHERE contratacion_proyectos.empleado_id=empleados.id AND contratacion_proyectos.id=8
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $id = $request->get('id');
        $contrataciones = ContratacionProyecto::where('contratoproyecto_id',$id)->get();
        return view('contratacionproyectos.index',compact('contrataciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $proyecto = ContratoProyecto::findorFail($id);

      //dd($proyecto->proyecto->nombre);
        return view('contratacionproyectos.create',compact('proyecto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
          DB::beginTransaction();
          try{
            $contrato = ContratacionProyecto::create([
              'contratoproyecto_id' => $request->proyecto,
              'empleado_id' => $request->empleado,
              'cargo' => $request->cargo,
              'salario' => $request->salario,
              'fecha_revision' => $request->fecharevision,
              'fecha_contratacion' => date('Y-m-d'),
            ]);

            foreach($request->funciones as $funcion){
              EPFuncione::create([
                'contratacionproyecto_id' => $contrato->id,
                'funcion' => $funcion['funcion'],
              ]);
            }
            DB::commit();
            return response()->json([
              'mensaje' => 'exito',
            ]);
          }catch(\Exception $e){
            DB::rollback();
            return response()->json([
              'mensaje' => 'error',
              'codigo' => $e->getMessage(),
            ]);
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
    public function destroy($id)
    {
        //
    }
}
