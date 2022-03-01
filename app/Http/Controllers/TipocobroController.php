<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipocobro;
use App\Bitacora;

class TipocobroController extends Controller
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
    public function index()
    {
        $tipocobros = Tipocobro::all();
        return view('tipocobros.index',compact('tipocobros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipocobros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tipocobro::create($request->All());
        return redirect('tipocobros')->with('mensaje','Registro almacenado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipocobro = Tipocobro::findorFail($id);
        return view('tipocobros.show',compact('tipocobro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipocobro = Tipocobro::findorFail($id);
        return view('tipocobros.edit',compact('tipocobro'));
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
        $tipocobro = Tipocobro::find($id);
        $tipocobro->fill($request->All());
        $tipocobro->save();
        bitacora('Modificó un tipo');
        return redirect('/tipocobros')->with('mensaje','El tipo de cobro se modificó con éxito');
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
