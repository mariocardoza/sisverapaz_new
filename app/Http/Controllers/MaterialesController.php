<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materiales;
use Validator;

class MaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $materiales=Materiales::all();
        return view('materiales.index',compact('materiales'));
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
            $material=Materiales::create([
                'id'=>date('Yidisus'),
                'nombre'=>$request->nombre,
                'categoria_id'=>$request->categoria_id,
                'servicio'=>$request->servicio,
                'precio_estimado'=>$request->precio_estimado
            ]);
            return array(1,"exito",$material);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
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
        $retorno = Materiales::modal_editar($id);
        return $retorno;
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
            $material=Materiales::find($id);
            $material->fill($request->all());
            $material->save();
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
        //
    }

    public function modaleditar($id)
    {
        $retorno=Materiales::modal_editar($id);
        return $retorno;
    }

    protected function validar(array $data)
    {
        $mensajes=array(
            'nombre.required'=>'El nombre del material es obligatorio',
            'precio_estimado.required' => 'El precio estimado es obligatorio'
        );
        return Validator::make($data, [
            'nombre' => 'required',
            'precio_estimado' => 'required',
        ],$mensajes);

        
    }

    public function baja($cadena)
    {
        $datos = explode("+", $cadena);
        $id = $datos[0];
        $motivo = $datos[1];
        $especialista = Materiales::find($id);
        $especialista->estado = 2;
  
        $especialista->save();
        bitacora('Di?? de baja un material');
        return redirect('materiales')->with('mensaje','Registro dado de baja');
    }

    public function alta($id)
    {
        $especialista = Materiales::find($id);
        $especialista->estado = 1;
        
        $especialista->save();
        bitacora('Di?? de alta un material');
        return redirect('materiales')->with('mensaje','Registro dado de alta');
    }
}
