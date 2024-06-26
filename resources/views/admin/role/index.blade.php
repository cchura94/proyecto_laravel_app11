@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1>Gestión Categorias</h1>
@stop

@section('content')


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Nueva Role
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('role.store') }}" method="post">
        @csrf
      <div class="modal-body">
        <label for="">Ingrese Role</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Guardar Role</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="permisos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('role.store') }}" method="post">
        @csrf
      <div class="modal-body">
        <label for="">Ingrese Role</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Guardar Role</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{ $roles }}
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>ACCION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#permisos">asignar Permisos</button>
                @foreach($permisos as $permiso)
                <input type="checkbox"> {{ $permiso->name}}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection