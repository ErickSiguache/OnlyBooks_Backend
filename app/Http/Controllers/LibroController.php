<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::all();
        return compact('libros');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        /*$libro = new Libro();
        $libro -> tituloLibro = $request->input('tituloLibro');
        $libro -> description = $request->input('description');
        $libro -> categoria = $request->input('categoria');
        $libro -> autores = $request->input('autores');
        $libro -> editorial = $request->input('editorial');
        $libro -> save();
        return response()->json($libro);*/

        $libro = $request -> File('pdf') -> store('public/PdfLibros');
        $url = Storage::url($libro);
        $libro = array(
            'tituloLibro' => $request->input('tituloLibro'),
            'description' => $request->input('description'),
            'categoria' => $request->input('categoria'),
            'autores' => $request->input('autores'),
            'editorial' => $request->input('editorial'),
            'pdf' => $url
        );
        $libro = Libro:: create($libro);

        return response()->json($libro);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Libro::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libros = Libro::findOrFail($id);
        return view('libros.edit', compact('libros'));
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
        $libro = Libro::find($id);
        $libro->update($request->all());
        return ('Libro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Libro::destroy($id);
        return ('El libro fue eliminado');
    }
}
