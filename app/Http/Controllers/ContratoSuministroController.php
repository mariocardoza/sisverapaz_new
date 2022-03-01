<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContratoSuministro;
use App\Proveedor;
use App\Requisicion;
use App\Bitacora;

class ContratoSuministroController extends Controller
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
        $contratosuministros = ContratoSuministro::all();
        return view('contratosuministros.index',compact('contratosuministros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd($requisiciones);
        $proveedores = Proveedor::all();
        $requisiciones = Requisicion::all();
        $contratosuministros = ContratoSuministro::all();
        return view('contratosuministros.create',compact('proveedores','requisiciones','contratosuministros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ContratoSuministro::crate($request->All());
        return redirect('contratosuministros')->with('mensaje','Contrato registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contratosuministro = ContratoSuministro::findorFail($id);
        return view('contratosuministros.show',compact('contratosuministro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contratosuministro = ContratoSuministro::find($id);
        return view('contratosuministros.edit',compact('contratosuministro'));
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
        $contratosuministro = ContrataSuministro::find($id);
        $contratosuministro->fill($request->All());
        $contratosuministro->save();
        bitacora('Modificó contrato');
        return redirect('contratosuministros')->with('mensaje','Registro modificado');
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

    public function baja($cadena)
    {
        $datos = explode("+", $cadena);
        $id = $datos[0];
        $motivobaja = $datos[1];

        $contratosuministro = ContratoSuministro::find($id);
        $contratosuministro->estado = 2;
        $contratosuministro->motivobaja = $motivobaja;
        $contratosuministro->fecha_baja = date('Y-m-d');
        $suministro->save();
        bitacora('Dió de baja contratro');
        return redirect('/suministros')->with('mensaje',
            'Contrato dado de baja');
    }

    public function alta($id)
    {
        $contratosuministro = ContratoSuministro::find($id);
        $contratosuministro->estado = 1;
        $contratosuministro->motivobaja = null;
        $contratosuministro->fecha_baja = null;
        $contratosuministro->save();
        Bitacora::bitacora('Dió de alta un contrato');
        return redirect('/contratosuministros')->with('mensaje','Contrato dado de alta');
    }
}
