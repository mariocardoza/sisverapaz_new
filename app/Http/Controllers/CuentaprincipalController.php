<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Cuentaprincipal;

class CuentaprincipalController extends Controller
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
     
    public function index()
    {
        $cuentas = Cuentaprincipal::all();
        return view('cuentaprincipal.index',compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anio = date('Y');
        $cuenta = Cuentaprincipal::where('anio',$anio)->first();
        //dd($cuenta);
        return view('cuentaprincipal.create',compact('cuenta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anio=date('Y')-1;
        $anterior=Cuentaprincipal::where('anio',$anio)->first();
        if($anterior != null){
          $monto=$anterior->monto_inicial;
          $anterior->monto_inicial=0;
          $anterior->estado=2;
          $anterior->save();
        }else{
          $monto=0.0;
        }

        $cuenta= new Cuentaprincipal();
        $cuenta->numero_de_cuenta=$request->numero_de_cuenta;
        $cuenta->banco=$request->banco;
        $cuenta->anio=$request->anio;
        $cuenta->monto_inicial=$request->monto_inicial+$monto;
        $cuenta->save();
        return redirect('cuentaprincipal');
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
        $cuenta=Cuentaprincipal::findorFail($id);
        return view('cuentaprincipal.edit',compact('cuenta'));
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
        $cuenta=Cuentaprincipal::find($id);
        $cuenta->fill($request->All());

        return redirect('cuentaprincipal');
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
