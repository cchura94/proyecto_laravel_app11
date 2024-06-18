@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Gestión Productos</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('producto.create') }}" class="btn btn-primary">Nuevo Producto</a>

                </div>
                <div class="col-md-6">

                    <form action="{{ route('buscar-producto') }}" method="get">
                        @csrf
                        <input type="search" name="buscar" class="form-control">
                        <input type="submit" value="buscar" class="btn btn-info">
                    </form>
                </div>
            </div>
                
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>NOMBRE</td>
                            <td>PRECIO</td>
                            <td>STOCK</td>
                            <td>CATEGORIA</td>
                            <td>IMAGEN</td>
                            <td>ACCION</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->nombre }}</td>
                            <td>{{ $prod->precio }}</td>
                            <td>{{ $prod->stock }}</td>
                            <td>{{ $prod->categoria->nombre }}</td>
                            <td>
                                <img src="{{ asset($prod->imagen) }}" alt="" width="50px">
                            </td>
                            <td>
                                <a href="{{ route('producto.edit', $prod->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('producto.destroy', $prod->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $productos->links() }}
            </div>
        </div>

    </div>
</div>

@endsection
