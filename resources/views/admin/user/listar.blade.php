
@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Gestión Usuarios</h1>
@stop

@section('content')
<h1>LIsta de Usuarios</h1>

<a href="/usuario/create">Nuevo Usuario</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
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