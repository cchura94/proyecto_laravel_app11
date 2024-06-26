@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1>Gestión Usuarios</h1>
@stop

@section('content')
<h1>LIsta de Usuarios</h1>

<a class="btn btn-info" href="/usuario/create">Nuevo Usuario</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>ROLES</th>
            <th>CREADO EN</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $us)
        <tr>
            <td>{{ $us->id }}</td>
            <td>{{ $us->name }}</td>
            <td>{{ $us->email }}</td>
            <td>
                {{ $us->getRoleNames() }}


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#role-{{ $us->id }}">
                    Asignar Roles
                </button>

                <!-- Modal -->
                <div class="modal fade" id="role-{{ $us->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Asignar Roles</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('add-role', $us->id) }}" method="post">
                                @csrf

                                <div class="modal-body">

                                    <select name="role_id" id="" class="form-control">
                                        @foreach($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Asignar Rol</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </td>
            <td>{{ $us->created_at }}</td>
            <td>
                <a href="/usuario/{{ $us->id }}/edit">editar</a>

                <form action="/usuario/{{ $us->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="eliminar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop