<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif; /* Establecer la fuente para el documento */
        }
        h1 {
            text-align: center; /* Centrar el título */
        }
        table {
            width: 100%; /* Ancho completo de la tabla */
            border-collapse: collapse; /* Colapsar los bordes de la tabla */
            margin-top: 20px; /* Margen superior */
        }
        table, th, td {
            border: 1px solid black; /* Bordes para la tabla y las celdas */
        }
        th, td {
            padding: 8px; /* Espaciado interno para las celdas */
            text-align: left; /* Alineación del texto a la izquierda */
        }
        td img {
            max-width: 100px; /* Tamaño máximo para las imágenes en las celdas */
            height: auto; /* Mantener la proporción de la imagen */
            display: block; /* Evitar el espacio adicional debajo de la imagen */
            margin: 0 auto; /* Centrar la imagen horizontalmente */
        }
    </style>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>DESCRIPCIÓN</th>
            <th>IMAGEN</th>
        </tr>
        @foreach($productos as $prod)
        <tr>
            <td>{{ $prod->id }}</td>
            <td>{{ $prod->nombre }}</td>
            <td>{{ $prod->precio }}</td>
            <td>{{ $prod->stock }}</td>
            <td>{{ $prod->descripcion }}</td>
            <td>
                @if($prod->imagen)
                    <img src="{{ './'.$prod->imagen }}" alt="Imagen Producto">
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>

