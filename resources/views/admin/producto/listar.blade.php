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

                <a href="{{ route('producto.create') }}" class="btn btn-primary">Nuevo Producto</a>
                
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
                            <td></td>
                            <td></td>
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
