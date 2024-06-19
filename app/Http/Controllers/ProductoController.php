<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $productos = Producto::get();
        $productos = Producto::orderBy('id', 'desc')->paginate(5);

        return view("admin.producto.listar", compact('productos'));
    }

    public function buscarProductos(Request $request){
        $buscar = $request->buscar;

        $productos = Producto::where('nombre', 'like', "%$buscar%")->orderBy('id', 'desc')->paginate(5);
        
        return view("admin.producto.listar", compact('productos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::get();

        return view("admin.producto.nuevo", compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validacion
        $request->validate([
            "nombre" => "required",
            "precio" => "required",
            "categoria_id" => "required",

        ]);

        $direccion_imagen = "";
        if ($file = $request->file("imagen")) {
            $direccion_imagen = time() . "-" . $file->getClientOriginalName();
            $file->move("imagenes/", $direccion_imagen);

            $direccion_imagen = "imagenes/" . $direccion_imagen;
        }

        // guardar
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $direccion_imagen;
        $producto->save();

        return redirect()->route("producto.index");
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
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::get();

        return view("admin.producto.editar", ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            "nombre" => "required",
            "precio" => "required",
            "categoria_id" => "required",

        ]);

        $producto = Producto::findOrFail($id);

        if ($file = $request->file("imagen")) {
            $direccion_imagen = "";
            $direccion_imagen = time() . "-" . $file->getClientOriginalName();
            $file->move("imagenes/", $direccion_imagen);

            $direccion_imagen = "imagenes/" . $direccion_imagen;
            $producto->imagen = $direccion_imagen;
        }

        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->update();

        return redirect()->route("producto.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generarReportePDF(){
        $productos = Producto::get();

        $pdf = Pdf::loadView('pdf.productos', ["productos" => $productos]);
        return $pdf->download('productos.pdf');
    }

    public function funApiProductos(){
        $productos = Producto::get();

        return response()->json($productos, 200);
    }
}
