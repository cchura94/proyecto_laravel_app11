
@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Gestión Usuarios</h1>
@stop

@section('content')
<h1>Nuevo Usuario</h1>

<form action="/usuario" method="post">
    @csrf
    <label for="">Ingrese Nombre</label>
    <input type="text" name="name">
    <br>
    <label for="">Ingrese su Correo:</label>
    <input type="email" name="email">
    <br>
    <label for="">Ingrese la contraseá</label>
    <input type="password" name="password">
    <br>
    <input type="submit" value="Guardar Usuario">
</form>

@stop