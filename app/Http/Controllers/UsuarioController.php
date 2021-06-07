<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; //Esto es para generar un string aleatorio como token

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return compact('usuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valor random el cual genera y dejara como token con 40 caracteres
        //https://www.codegrepper.com/code-examples/php/how+to+generate+random+token+in+laravel
        $token = Str::random(32);
        //Proceso normal del crud
        $usuario = new Usuario();
        $usuario -> nombre = $request->input('nombre');
        $usuario -> apellido = $request->input('apellido');
        $usuario -> telefono = $request->input('telefono');
        $usuario -> email = $request->input('email');
        $usuario -> username = $request->input('username');
        $usuario -> password = $request->input('password');
        $usuario -> TipUser = $request->input('TipUser');
        $usuario -> ImgPerfil = $request->input('ImgPerfil');
        $usuario -> token = $token;
        $usuario -> save();
        return response()->json($usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $usuarios = Usuarios::where('username', $username ) ->get();
        return response()->json($usuarios);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
        //$usuario = Usuario::find($id);
        //$usuario->update($request->all());
        //return ('Usuario actualizado');
        //Se consulta el 
        //$usuarios = Usuarios::where('username', $username ) ->get();
        //return response()->json($usuarios);
        //
        //Datos de la base de datos y Se busca el token y su id
        //Se maneja el arreglo con Arr:get()
        //https://styde.net/manejo-de-arreglos-con-laravel/
        $userUpdate = Usuario::where('token', $token ) ->get();
        $userID = Arr::get($userUpdate[0], '_id');
        $Usuario=Usuario::where("token",$token) ->update($request->all());
        return ('Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Usuario::destroy($id);
        return ('El usuario fue eliminado');
    }
}
