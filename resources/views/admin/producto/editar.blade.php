@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')



<form action="{{ route('producto.update', $producto->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <label for="">Ingrese Nombre Producto</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $producto->nombre }}">
            
                        @error('nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <label for="">Ingrese Precio</label>
                        <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ $producto->precio }}">
                
                        @error('precio')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-4">
                        <label for="">Ingrese Stock</label>
                        <input type="number" class="form-control" name="stock" value="{{ $producto->stock }}">
                        
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-8">

                        <label for="">Categoria</label>
                        <select name="categoria_id" id="" class="form-control">
                            <option value="">Seleccione una opción</option>
                            @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ ($producto->categoria_id == $cat->id)?'selected':'' }}>{{ $cat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="">Ingrese Descripción</label>
                        <textarea name="descripcion" class="form-control" id="" cols="30" rows="10">{{$producto->descripcion}}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="">Seleccione Imagen (Para Cambiar)</label>
                        <input type="file" name="imagen" class="form-control">
                        <label for="">Imagen Actual</label>
                        <img src="{{ asset($producto->imagen) }}" alt="" width="100%">
                    </div>
                    
                </div>



            </div>

        </div>
        
        </div>
        <div class="md-4">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary  btn-block">Modificar Producto</button>


                </div>
            </div>
        </div>
    </div>
</form>

@endsection