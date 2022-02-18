<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoInventario;

class ProyectoInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getMaterial($id)
     {
       return ProyectoInventario::with('proyecto')->findorFail($id);
     }

    public function index(Request $request)
    {

        $inventarios = ProyectoInventario::where('proyecto_id',$request->get('proyecto'))->orderBy('descripcion')->get();
        //dd($inventarios);
        return view('inventarios.index',compact('inventarios'));
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
        if($request->Ajax())
        {
          try{
            $id=$request->idm;
            $desc=$request->desc;
            $inventario=ProyectoInventario::findorFail($id);
            $inventario->cantidad=$inventario->cantidad-$desc;
            $inventario->save();
            return response()->json([
              'mensaje' => 'exito',
              'proyecto' => $request->idp
            ]);
          }catch(\Exception $e){
            return response()->json([
              'mensaje' => 'error'
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
