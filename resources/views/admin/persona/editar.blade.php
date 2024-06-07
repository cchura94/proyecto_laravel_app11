<h1>Editando</h1>

<form action="/persona/{{ $persona->id }}" method="post">
    @csrf
    @method("PUT")
    <label for="">Nombres</label>
    <input type="text" name="nombres" value="{{ $persona->nombres }}">
    <br>
    <label for="">Apellidos</label>
    <input type="text" name="apellidos" value="{{ $persona->apellidos }}">
    <br>

    <label for="">CI</label>
    <input type="text" name="ci" value="{{ $persona->ci }}">
    <br>

    <label for="">Fecha Nacimiento</label>
    <input type="date" name="fecha_nac" value="{{ $persona->fecha_nac }}">
    <br>

    <input type="submit" value="MODIFICAR">
</form>