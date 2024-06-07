<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * funListar
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = DB::select("select * from users");

        return view("admin.user.listar", compact("usuarios"));
    }

    /**
     * funCrear
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.crear");
    }

    /**
     * funGuardar
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);

        DB::insert("insert into users (name, email, password) values (?,?,?)", [$name, $email, $password]);

        return redirect("/usuario");
    }

    /**
     * funMostrar
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * funEditar
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = DB::select("select * from users where id=$id");
        $usuario = $usuario[0];
        

        return view("admin.user.editar", compact("usuario"));
    }

    /**
     * funModificar
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->name;
        $email = $request->email;
        $password = bcrypt($request->password);

        $usuario = DB::update("update users set name=?, email=?, password=? where id=?", [$name, $email, $password, $id]);
        
        return redirect("/usuario");
    }

    /**
     * funEliminar
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::delete("delete from users where id=?", [$id]);

        return redirect("/usuario");

    }
}
