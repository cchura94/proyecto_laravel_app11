
@extends('adminlte::page')

@section('title', 'Productos')

@section('content')

<div id="app">
    <h1>@{{ mensaje }}</h1>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PRODUCTO</th>
                                <th>PRECIO</th>
                                <th>STOCK</th>
                                <th>IMAGEN</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $prod)
                            <tr>
                                <td>{{ $prod->nombre }}</td>
                                <td>{{ $prod->precio }}</td>
                                <td>{{ $prod->stock }}</td>
                                <td>{{ $prod->imagen }}</td>
                                <td>
                                    <button class="btn btn-success" v-on:click="funAddCarrito({{$prod}})">+</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
        
                    </table>

                </div>
            </div>
           
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2>Carrito</h2>
                    
                    <table class="table">
                        <tr>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>C</th>
                            <th>ACCION</th>
                        </tr>
                        <tr v-for="(pr, pos) in carrito">
                            <td>@{{ pr.nombre }}</td>
                            <td>@{{ pr.precio }}</td>
                            <td>@{{ pr.cantidad }}</td>
                            <td>
                                <button class="btn btn-danger" v-on:click="funQuitarCarrito(pos)">x</button>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
    
    <button v-on:click="funCambiarMensaje()">CAMBIAR Mensaje</button>
</div>
@endsection



@section('js')
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
const { createApp, ref, onMounted } = Vue

createApp({
  setup() {
    const mensaje = ref('Hola Laravel soy Vue!');
    const carrito = ref([]);

    onMounted(() => {
        obtenerProductos()
    })

    function funCambiarMensaje(){
        mensaje.value = "Nuevo Mensaje";
    }

    function funAddCarrito(producto){
        let prod = {id: producto.id, cantidad: 1, nombre: producto.nombre, precio: producto.precio}
        
        carrito.value.push(prod);

    }

    function funQuitarCarrito(pos){
        carrito.value.splice(pos, 1);
    }

    async function obtenerProductos(){
        const productos = await axios.get('http://127.0.0.1:8000/productos-api')
        console.log(productos)
    }

    return {
      mensaje,
      funCambiarMensaje,
      carrito,
      funAddCarrito,
      funQuitarCarrito,
      obtenerProductos
    }
  }
}).mount('#app')
</script>
@stop