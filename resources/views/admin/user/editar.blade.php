
@extends('adminlte::page')

@section('title', 'Editar Usuarios')

@section('content_header')
    <h1>Edición Usuarios</h1>
@stop

@section('content')
<h1>Editar Usuario</h1>

<form action="/usuario/{{ $usuario->id }}" method="post">
    @csrf
    @method('PUT')
    <label for="">Ingrese Nombre</label>
    <input type="text" name="name" value="{{ $usuario->name }}">
    <br>
    <label for="">Ingrese su Correo:</label>
    <input type="email" name="email" value="{{ $usuario->email }}">
    <br>
    <label for="">Ingrese la contraseá</label>
    <input type="password" name="password" value="">
    <br>
    <input type="submit" value="Modificar Usuario">
</form>
@stop
