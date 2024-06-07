<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;

class PersonaController extends Controller
{

    public function funListarAjax(){
        $personas = Persona::get(); // select * from personas

        $usuarios = User::get();

        return response()->json(["personas" => $personas, "usuarios" =>$usuarios]);
    }

    public function funListar(){
        $personas = Persona::get(); // select * from personas

        $usuarios = User::get();

        return view("admin.persona.listar", ["personas" => $personas, "usuarios" =>$usuarios]);
    }

    public function funCrear(){
        return view("admin.persona.nuevo");
    }
    
    public function funGuardar(Request $request){
        $persona = new Persona;
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci = $request->ci;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->save();

        return redirect("/persona");

    }
    public function funMostrar(){

    }
    public function funEditar($id){

        $persona = Persona::find($id);

        return view("admin.persona.editar", ["persona" => $persona]);
    }
    public function funModificar($id, Request $request){

        $persona = Persona::find($id);
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci = $request->ci;
        $persona->fecha_nac = $request->fecha_nac;
        $persona->update();

        return redirect("/persona");

    }
    public function funEliminar($id){

        $persona = Persona::find($id);
        $persona->delete();

        return redirect("/persona");
    }

    public function asignarPersona($id, Request $request){
        $persona = Persona::find($id);

        $persona->user_id = $request->user_id;
        $persona->update();
        return redirect("/persona");

    }
}
