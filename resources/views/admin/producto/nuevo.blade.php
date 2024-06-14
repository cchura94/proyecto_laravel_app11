@extends('adminlte::page')

@section('title', 'Nuevo Producto')

@section('content_header')
    <h1>Nuevo Producto</h1>
@stop

@section('content')



<form action="{{ route('producto.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <label for="">Ingrese Nombre Producto</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
    
                @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="">Ingrese Precio</label>
                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" name="precio">
        
                @error('precio')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="">Ingrese Stock</label>
                <input type="number" class="form-control" name="stock">
                
                @error('stock')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="">Categoria</label>
                <select name="categoria_id" id="" class="form-control">
                    <option value="">Seleccione una opción</option>
                    @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>

            </div>

        </div>
        
        </div>
        <div class="md-4">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary  btn-block">Guardar Producto</button>
                    <button type="submit" class="btn btn-success btn-block">Reporte PDF</button>
                    <button type="submit" class="btn btn-info btn-block">Reporte EXCEL</button>

                </div>
            </div>
        </div>
    </div>
</form>

@endsection