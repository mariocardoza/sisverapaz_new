<?php

namespace App\Http\Controllers;

use App\Cementerio;
use App\CementeriosPosiciones;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;

class CementerioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        Auth()->user()->authorizeRoles(['admin','catastro']);
        if($r->ajax()){
            $cementerio=Cementerio::findorFail($r->id);
            return array(1,$cementerio,$cementerio->posiciones);
        }else{
            $cementerios=Cementerio::all();
            return view('cementerios.index',\compact('cementerios'));
        }
    }

    private function generatePointsArray($posiciones) {
        $response = array();
        foreach ($posiciones as $value) {
            array_push($response, $value['latitud'].', '.$value['longitud']);
        }       
        return $response; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth()->user()->authorizeRoles(['admin','catastro']);
        $cementerio = [];
        $isDrawing = true;
        
        $gmap = new GMaps();
        $config = array();
        $config['center'] = '13.644985, -88.865193';
        $config['zoom'] = '19';
        $config['map_type'] = 'SATELLITE';
        $config['map_height'] = "100%";
        $config['scrollwheel'] = true;        
        $config['drawingModes'] = array('polygon');
        
        if ($cementerio) {
            $isDrawing = false;
            $polygon = array();
            $polygon['points'] = self::generatePointsArray($cementerio->posiciones);
            $polygon['strokeColor'] = '#000099';
            $polygon['fillColor'] = '#000099';
            $gmap->add_polygon($polygon);
        } else { 
            $config['drawing'] = true;
            $config['drawingDefaultMode'] = 'polygon';            
        }
        
        $gmap->initialize($config);
        $map = $gmap->create_map();
        return view("cementerios.create", [
            "map"           => $map,
            "isDrawing"     => $isDrawing,
            "cementerio"    => $cementerio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $cementerio = new Cementerio;
        $cementerio->nombre = $params["form"]["nombre"];
        $cementerio->maximo = $params["form"]["maximo"];
        if($cementerio->save()) {
            foreach ($params["pointers"] as $key => $value) {    
                $posion = new CementeriosPosiciones;
                $posion->latitud = $value[0];
                $posion->longitud = $value[1];
                $posion->cementerio_id = $cementerio->id;
                $posion->save();
            }
            // por si todo sale bien
            return $cementerio;
        } else {
            // por si hay error
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cementerio  $cementerio
     * @return \Illuminate\Http\Response
     */
    public function show(Cementerio $cementerio)
    {
        $cementerio = Cementerio::findorFail($cementerio->id);
        $isDrawing = true;
        
        $gmap = new GMaps();
        $config = array();
        $config['center'] = $cementerio->posiciones[0]['latitud'].','.$cementerio->posiciones[0]['longitud'];
        $config['zoom'] = '18';
        $config['map_height'] = "100%";
        $config['map_type'] = 'SATELLITE';
        $config['scrollwheel'] = true;     
        $config['drawingModes'] = array('polygon');
        if ($cementerio) {
            $isDrawing = false;
            $polygon = array();
            $polygon['points'] = self::generatePointsArray($cementerio->posiciones);
            $polygon['strokeColor'] = '#000099';
            $polygon['fillColor'] = '#000099';
            $gmap->add_polygon($polygon);
        } else { 
            $config['drawing'] = true;
            $config['drawingDefaultMode'] = 'polygon';            
        }
        
        $gmap->initialize($config);
        $map = $gmap->create_map();
        return view("cementerios.show", [
            "map"           => $map,
            "isDrawing"     => $isDrawing,
            "cementerio"    => $cementerio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cementerio  $cementerio
     * @return \Illuminate\Http\Response
     */
    public function edit(Cementerio $cementerio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cementerio  $cementerio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cementerio $cementerio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cementerio  $cementerio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cementerio $cementerio)
    {
        //
    }

    public function baja($id,Request $r)
    {
        try{
            $contribuyente = Cementerio::find($id);
            $contribuyente->estado=2;
            $contribuyente->motivo_baja=$r->motivo;
            $contribuyente->fecha_baja=date('Y-m-d');
            $contribuyente->save();
            bitacora('Dió de baja a un cementerio');
            return array(1,"exito",$contribuyente);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    public function alta($id)
    {
        try{
            $contribuyente = Cementerio::find($id);
            $contribuyente->estado=1;
            $contribuyente->motivo_baja="";
            $contribuyente->fecha_baja=null;
            $contribuyente->save();
            bitacora('Dió de alta a un cementerio');
            return array(1,"exito",$contribuyente);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }
}
