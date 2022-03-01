<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuracion;
use App\User;
use App\Notificacion;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
use DB;
class HomeController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracion=Configuracion::first();
        //$proyectos=null;
        
        $proyectos=[];

        $morosos = DB::table('factura_negocios as fn')
            ->select('n.nombre','n.lat','n.lng','n.direccion','n.id',
            DB::raw('(select SUM(fn.pagoTotal)) as deuda'))
            ->join('negocios as n','n.id','=','fn.negocio_id','inner')
            ->where('fn.estado','=',1)
            ->where('fn.fechaVencimiento','<',date("Y-m-d"))
            ->groupBy('n.id','fn.negocio_id','n.nombre','n.lat','n.lng','n.direccion','n.id','fn.pagoTotal')
            ->get();
        if($configuracion!='')
        {
            return view('home',compact('proyectos','morosos'));
        }else{
            return redirect('configuraciones');
        }
        
    }

    public function saveComment(Request $request){
        $notificacion = new Notificacion();
        $notificacion->tabla = $request->tabla;
        $notificacion->tabla_id = $request->tabla_id;
        $notificacion->destinatario_id = $request->destinatario_id;
        $notificacion->mensaje = $request->comentario;
        $notificacion->remitente_id = auth()->user()->id;
        $notificacion->save();

        if($request->tabla=="Requisicione"){
            $requi = \App\Requisicione::find($request->tabla_id);
            $requi->observaciones = $request->comentario;
            $requi->save();
        }
        return array(1);
    }

    public function autorizacion(Request $request)
    {
        $this->validacion($request->all())->validate();
        if (Auth::once(['username' => $request->username, 
            'password' => $request->password,'estado' => 1])
            ) {
                sleep(3);
            return array(1,"exito",Auth()->user()->hasRole('admin'));
        }else{
            return array(-1,"error");
        }
        
    }

    protected function validacion($data)
    {
        $mensajes=array(
            'username.required'=>'El nombre de usuario el obligatorio',
            'password.required'=>'La contraseña es obligatoria',
        );
        return Validator::make($data, [
            'username' => 'required',
            'password' => 'required',

        ],$mensajes);
    }
}
