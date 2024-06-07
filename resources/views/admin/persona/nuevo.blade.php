<h1>Nueva Persona</h1>

<form action="/persona" method="post">
    @csrf
    <label for="">Nombres</label>
    <input type="text" name="nombres">
    <br>
    <label for="">Apellidos</label>
    <input type="text" name="apellidos">
    <br>

    <label for="">CI</label>
    <input type="text" name="ci">
    <br>

    <label for="">Fecha Nacimiento</label>
    <input type="date" name="fecha_nac">
    <br>

    <input type="submit">
</form>