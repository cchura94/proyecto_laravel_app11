<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function(){
    
    Route::get('/', function () {
        return view('admin.admin');
    });
    // buscador de productos
    // 
    Route::get("/producto/buscar-producto", [ProductoController::class, "buscarProductos"])->name("buscar-producto");

    Route::post("/persona/{id}/asignar", [PersonaController::class, "asignarPersona"]);
    
    Route::get("/persona_ajax", [PersonaController::class, "funListarAjax"]);
    
    // CRUD PERSONA
    // listar (GET)
    Route::get("/persona", [PersonaController::class, "funListar"]);
    // crear  (GET)
    Route::get("/persona/crear", [PersonaController::class, "funCrear"]);
    // guardar (POST)
    Route::post("/persona", [PersonaController::class, "funGuardar"]);
    // mostrar (GET)
    Route::get("/persona/{id}", [PersonaController::class, "funMostrar"]);
    // editar (GET)
    Route::get("/persona/{id}", [PersonaController::class, "funEditar"]);
    // modificar (PUT)
    Route::put("/persona/{id}", [PersonaController::class, "funModificar"]);
    // eliminar (DELETE)
    Route::delete("/persona/{id}", [PersonaController::class, "funEliminar"]);
    
    // CRUD Usuarios - Controlador de recursos
    Route::resource("/usuario", UsuarioController::class);
    
    // CRUD Para categoria
    Route::resource("categoria", CategoriaController::class);// ->middleware("auth");
    
    // CRUD DE Productos
    Route::resource("/producto", ProductoController::class);// ->middleware("auth");

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
