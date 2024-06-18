@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1>Gestión Categorias</h1>
@stop

@section('content')




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/categoria" method="post">
                <div class="modal-body">
                    @csrf
                    <label for="">Ingrese Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                    <br>
                    <label for="">Ingrese Detalle</label>
                    <textarea name="detalle" id="" cols="30" rows="10" class="form-control"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <!-- Button trigger modal -->
        @auth
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Nueva Categoria
        </button>
        @else
        <h1>Para registrar categorias Necesitas Inciar Sesion</h1>
        @endauth

    </div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DETALLE</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->nombre }}</td>
                    <td>{{ $cat->detalle }}</td>
                    <!--<td> {{ $cat->productos }} </td>-->
                    <td>
                        <form action="/categoria/{{ $cat->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

{{-- $categorias --}}



@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
<script>
    Swal.fire({
        title: "Categoria Registrada!",
        text: "CLick para continuar!",
        icon: "success"
    });
</script>
@endif

@stop