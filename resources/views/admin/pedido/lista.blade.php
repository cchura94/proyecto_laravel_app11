@extends('adminlte::page')
@section('title', 'Lista Pedidos')

@section('content')

<pre>{{$pedidos}}</pre>
<div class="card">
    <div class="card-body">
        <table id="pedidos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th>ATENDIDO POR</th>
                    <th>PRODUCTOS</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->fecha }}</td>
                    <td>{{ $pedido->cliente->nombre_completo }}</td>
                    <td>{{ $pedido->user->email }}</td>
                    <td>
                        @foreach($pedido->productos as $prod)
                        <p>Nombre: {{$prod->nombre}},Precio: {{$prod->precio}} </p>
                        @endforeach
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#btn-mostrar-{{$pedido->id}}">
                            Mostrar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="btn-mostrar-{{$pedido->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> DETALLE DE PEDIDO: #{{ $pedido->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <h5>
                                                    CLIENTE: {{ $pedido->cliente->nombre_completo }}

                                                </h5>
                                                <h5>
                                                    CORREO: {{ $pedido->cliente->email }}
                                                </h5>

                                                <h5>
                                                    ATENDIDO POR: {{ $pedido->user->email }}
                                                </h5>

                                            </div>
                                            <div class="col-md-12">
                                                <h5>Productos</h5>
                                                <table class="table">
                                                    <thead>
                                                        @foreach($pedido->productos as $prod)
                                                        <tr>
                                                            <th>{{ $prod->nombre }}</th>
                                                            <th>{{ $prod->precio }}</th>
                                                            <th>{{ $prod->pivot->cantidad }}</th>
                                                        </tr>
                                                        @endforeach
                                                    </thead>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>


@endsection

@section('js')

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>

<script>
    new DataTable('#pedidos');
</script>

@stop

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
@stop