<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cargo;
use App\Http\Requests\UsuariosRequest;
use App\Http\Requests\ModificarUsuarioRequest;
class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','Admin']);
    } 
    
    public function index()
    {
        $usuarios=User::paginate(10);
    	//$usuarios = User::join('cargos','users.cargo','=', 'cargos.idcargo')->paginate(5);
    	return view('usuarios.index')->with('usuarios', $usuarios);
    }

    public function registro()
    {
        //$cargos =Cargo::all();
    	$cargos = Cargo::where('id' , '!=', 1)->get();
    	return view('usuarios.registro')->with('cargos',$cargos);
    }

    public function save(UsuariosRequest $request)
    {
    	User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'cargo' => $request['cargo'],
            'password' => bcrypt($request['password']),
        ]);
        bitacora('Registro un Usuario');
        return redirect('usuarios')->with('mensaje','Usuario almacenado con éxito');
    }

    public function buscar($id)
    {
        $usuario = User::find($id);
        $cargos =Cargo::all();
        //dd($cargos);
        return view('usuarios.modificar',compact('usuario','cargos'));
    }

    public function update(ModificarUsuarioRequest $request)
    {
        $id = $request['id'];
        $usuario = User::find($id);
        $usuario->fill($request->All());
       //dd($request->all());
        bitacora('Modificó un Usuario');
        $usuario->save();

        
        return redirect('usuarios');
    }

    public function borrar($id)
    {
        $usuario = User::find($id);
        return view('usuarios.borrar')->with('usuario',$usuario);
        

        return redirect('usuarios');
    }
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $usuario = User::find($id);

        $usuario->avatar = "hola.jpg";
        $usuario->save();
        return redirect('usuarios');
    }

    public function perfil()
    {
        return view('usuarios.perfil');
    }

    public function modificarperfil($id)
    {
        return view('usuarios.modificarperfil');
    }

    public function updateperfil(Request $request)
    {
        $id = $request['id'];
        $usuario = User::find($id);
        $usuario->fill($request->All());
       //dd($request->all());
        bitacora('Modificó su perfil');
        $usuario->save();
        return redirect('home/perfil');
    }
}
