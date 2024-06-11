<h1>Lista de Categorias</h1>

<form action="/categoria" method="post">
    @csrf
    <label for="">Ingrese Nombre</label>
    <input type="text" name="nombre">
    <br>
    <label for="">Ingrese Detalle</label>
    <textarea name="detalle" id="" cols="30" rows="10"></textarea>
    <br>
    <input type="submit" value="Guardar Categoria">
    
</form>

<table border="1">
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
            <td>
                <form action="/categoria/{{ $cat->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="eliminar">
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categorias }}