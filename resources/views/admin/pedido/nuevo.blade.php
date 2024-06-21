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
            <div class="card">
                <div class="card-body">
                    <h2>Cliente</h2>
                    <div class="row">
                        <div class="col-md-7">
                            <input type="text" v-model="buscar" v-on:keyup.enter="buscarCliente()" class="form-control" placeholder="buscar Clientes">
                        </div>
                        <div class="col-md-5">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Nuevo Cliente
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Datos Cliente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="">Ingrese Nombre</label>
                                            <input type="text" class="form-control" v-model="cliente.nombre_completo">
                                            <br>
                                            <label for="">Ingrese Correo</label>
                                            <input type="text" class="form-control" v-model="cliente.email">
                                            <br>
                                            <label for="">Ingrese Dirección</label>
                                            <input type="text" class="form-control" v-model="cliente.direccion">
                                            <br>
                                            
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary" v-on:click="funGuardarCliente()"  data-dismiss="modal">Guardar Cliente</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="cliente_seleccionado.id">
                            <h4>CLIENTE: @{{cliente_seleccionado.nombre_completo}}</h4>
                            <h4>CORREO: @{{cliente_seleccionado.email}}</h4>
                            <h4>DIRECCION: @{{cliente_seleccionado.direccion}}</h4>

                        </div>
                        <div class="col-md-12 ">
                            <button class="btn btn-block btn-success mt-5" v-on:click="funGuardarPedido()">Registrar Pedido</button>
                        </div>
                    </div>


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
    const {
        createApp,
        ref,
        onMounted
    } = Vue

    createApp({
        setup() {
            const mensaje = ref('Hola Laravel soy Vue!');
            const carrito = ref([]);
            const cliente_seleccionado = ref({});
            const buscar = ref("");
            const cliente = ref({});

            onMounted(() => {
                obtenerProductos()
            })

            function funCambiarMensaje() {
                mensaje.value = "Nuevo Mensaje";
            }

            function funAddCarrito(producto) {
                let prod = {
                    id: producto.id,
                    cantidad: 1,
                    nombre: producto.nombre,
                    precio: producto.precio
                }

                carrito.value.push(prod);

            }

            function funQuitarCarrito(pos) {
                carrito.value.splice(pos, 1);
            }

            async function obtenerProductos() {
                const productos = await axios.get('/productos-api')
                console.log(productos)
            }

            async function buscarCliente() {
                const {
                    data
                } = await axios.get('/cliente/buscar-api?buscar=' + buscar.value);
                cliente_seleccionado.value = data;
            }

            async function funGuardarCliente(){
                const {
                    data
                } = await axios.post('/cliente/guardar-api', cliente.value);
                cliente_seleccionado.value = data;
            }

            async function funGuardarPedido(){
                if(cliente_seleccionado.value.id){

                    const pedido_productos = [];

                    carrito.value.forEach(prod => {
                        pedido_productos.push({producto_id: prod.id, cantidad: prod.cantidad});
                    });

                    const pedido = {
                        cliente_id: cliente_seleccionado.value.id,
                        productos: pedido_productos
                    }

                    const {
                        data
                    } = await axios.post('/pedido', pedido);
                    alert("Pedido Registrado");

                    cliente_seleccionado.value = {}
                    carrito.value = [];
                    cliente.value = {}
                    
                }
                
            }

            return {
                mensaje,
                funCambiarMensaje,
                carrito,
                funAddCarrito,
                funQuitarCarrito,
                obtenerProductos,
                cliente_seleccionado,
                buscar,
                buscarCliente,
                cliente,
                funGuardarCliente,
                funGuardarPedido
            }
        }
    }).mount('#app')
</script>
@stop