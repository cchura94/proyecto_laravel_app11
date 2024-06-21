<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();

        return view("admin.cliente.listar", ["clientes" => $clientes]);
    }

    public function funBusqueda(Request $request){
        
        $cliente = Cliente::where("nombre_completo", "like", "%$request->buscar%")
                            ->orWhere("email", "like", "%$request->buscar%")
                            ->first();        

        return response()->json($cliente);
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
        $request->validate([
            "nombre_completo" => "required",
            "email" => "required"
        ]);

        $cliente = new Cliente();
        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return response()->back();
        
    }

    public function guardarApi(Request $request)
    {
        $request->validate([
            "nombre_completo" => "required",
            "email" => "required"
        ]);

        $cliente = new Cliente();
        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return response()->json($cliente);
        
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
        //
    }
}
