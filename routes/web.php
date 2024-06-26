<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get("/productos-api", [ProductoController::class, "funApiProductos"]);

Route::middleware('auth')->group(function(){


    Route::post("productos/add-permiso/{id}", [RoleController::class, "addPermiso"] );
    Route::post("productos/quitar-permiso/{id}", [RoleController::class, "quitarPermiso"] );
 
    
    Route::get('/', function () {
        $categorias = Categoria::with('productos')->get();
        return view('admin.admin', ["categorias" => $categorias]);
    });

    // busqueda de cliente (API)
    Route::get("/cliente/buscar-api", [ClienteController::class, "funBusqueda"]);
    Route::post("/cliente/guardar-api", [ClienteController::class, "guardarApi"]);
    
    // reporte PDF
    Route::get("/producto/reporte-general", [ProductoController::class, "generarReportePDF"])->name("reporteProductosGeneral");

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

    Route::resource('/pedido', PedidoController::class);

    Route::resource("/cliente", ClienteController::class);

    Route::resource("/role", RoleController::class);

});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
