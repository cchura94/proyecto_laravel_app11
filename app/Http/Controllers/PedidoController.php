<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::get();

        return view("admin.pedido.nuevo", ["productos" => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cliente_id" => "required",
            "productos" => "required"
        ]);

        $pedido = new Pedido();
        $pedido->fecha = date('Y-m-d H:i:s');
        $pedido->estado = 1;
        $pedido->cliente_id = $request->cliente_id;
        $pedido->user_id = Auth::user()->id;
        $pedido->save();

        foreach ($request->productos as $prod) {
            $pedido->productos()->attach($prod["producto_id"], ["cantidad" => $prod["cantidad"]]);
        }

        return response()->json(["mensaje" => "Pedido Registrado"]);
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
