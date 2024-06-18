<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function __construct(){
        // $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

        $categorias = Categoria::get(); // select * from categorias
        // return view("admin.categoria.listar", ["categorias" => $categorias]);
        return view("admin.categoria.listar", compact("categorias"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // guardar en BD
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save();

        return redirect()->back()->with("status", true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->back();
    }
}
