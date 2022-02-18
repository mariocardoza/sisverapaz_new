<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arbitrio;

class ArbitrioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','api']);
    }

    public function index()
    {
        Auth()->user()->authorizeRoles(['admin','catastro']);
        $rentas=Arbitrio::all();
        return view('arbitrio.index',compact('rentas'));
    }

    public function update($id, Request $request)
    {
        try{
            $renta=Arbitrio::find($id);
            $renta->fill($request->all());
            $renta->save();
            return array(1,$renta);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }
}
