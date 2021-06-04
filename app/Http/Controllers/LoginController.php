<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; //Esto es para generar un string aleatorio como token
use App\Usuario;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $response = "";
        //Sirve para extraer los datos de la peticion (Enviados por el front)
        $username = $request -> input('username');
        $password = $request -> input('password');
        //Con esto se buscar el Usuario en la Base de datos
        $usuario = Usuario::where('username', $username)
                        ->where('password', $password)
                        ->get();
        if($usuario -> isEmpty()){
            $respu = 'Usuario no existe';
        }elseif($usuario -> isNotEmpty()){
            $token = Str::random(32);
            $token2 = [
                'token' => $token
            ];
            $usuario2 = Usuario::where('username', $username)
                            ->where('password', $password)
                            ->update($token2, ['upsert' => true]);
            $respu = $token;
        }
        return response() -> json($respu);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token)
    {
        $token2 = [
            'token' => 'sinsesion'
        ];
        $usuario2 = Usuario::where('token', $token) 
                ->update($token2, ['upsert' => true]);
        $rerpu = $token;
        return response() -> json(['message' => 'Sesion Cerrada']);
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
