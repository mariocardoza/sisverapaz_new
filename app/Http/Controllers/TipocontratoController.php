<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipocontrato;
use App\Bitacora;
use App\Http\Requests\TipocontratoRequest;
use Illuminate\Support\Facades\Session;

class TipocontratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $estado = $request->get('estado');
        if($estado == "" )$estado=1;
        if ($estado == 1) {
            $tipocontratos = Tipocontrato::where('estado',$estado)->get();
            return view('tipocontratos.index',compact('tipocontratos','estado'));
        }
        if ($estado == 2) {
            $tipocontratos = Tipocontrato::where('estado',$estado)->get();
            return view('tipocontratos.index',compact('tipocontratos','estado'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipocontratos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipocontratoRequest $request)
    {
        Tipocontrato::create($request->All());
        bitacora('Registró un tipo de contrato');
        return redirect('/tipocontratos')->with('mensaje', 'El tipo de contrato se creo exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipocontrato = Tipocontrato::findorFail($id);

        return view('tipocontratos.show', compact('tipocontrato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipocontrato = Tipocontrato::find($id);
        return view('tipocontratos.edit',compact('tipocontrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(TipocontratoRequest $request, $id)
    {
        $tipocontrato = Tipocontrato::find($id);
        $tipocontrato->fill($request->All());
        $tipocontrato->save();
        bitacora('Modificó un tipo');
        return redirect('/tipocontratos')->with('mensaje','El tipo de contrato se modificó con éxito');
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
        $id=$datos[0];
        $motivo=$datos[1];
        //dd($id);
        $Tipocontrato = Tipocontrato::find($id);
        $Tipocontrato->estado=2;
        $Tipocontrato->motivo=$motivo;
        $Tipocontrato->fechabaja=date('Y-m-d');
        $Tipocontrato->save();
        bitacora('Dió de baja a un registro');
        return redirect('/tipocontratos')->with('mensaje','Registro dado de baja');
    }

    public function alta($id)
    {

        //$datos = explode("+", $cadena);
        ////$id=$datos[0];
        //$motivo=$datos[1];
        //dd($id);
        $Tipocontrato = Tipocontrato::find($id);
        $Tipocontrato->estado=1;
        $Tipocontrato->motivo=null;
        $Tipocontrato->fechabaja=null;
        $Tipocontrato->save();
        Bitacora::bitacora('Dió de alta a un registro');
        return redirect('/tipocontratos')->with('mensaje','Registro dado de alta');
    }
}