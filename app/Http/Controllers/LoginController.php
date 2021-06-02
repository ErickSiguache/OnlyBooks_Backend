<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $username = $request -> input('username');
        $password = $request -> input('password');
        $usuario = new Usuario();
        $usuarios = Usuarios::where('username', $username, 'password', $password ) ->get();
        if($usuarios -> isEmpty()){
            $respu = 'Usuario no existe';
        }elseif($usuarios -> isNotEmpty()){
            $token = Str::random(32);
            $token2 = ['token' => $token];
            $usuario2 = Usuarios::where('username', $username, 'password', $password) 
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
        $token2 = ['token' => 'sinsesion'];
        $usuario2 = Usuarios::where('token', $token) 
                ->update($token2, ['upsert' => true]);
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
