@extends('adminlte::page')

@section('title', 'Administración')

@section('content_header')
<h1>Administración</h1>


@stop

@section('content')


<h1>ADMINISTRACIÓN</h1>
<div class="row">
    <div class="col-md-6">
        <canvas id="myChart"></canvas>

    </div>
    <div class="col-md-6">

        <canvas id="myChart2"></canvas>

    </div>
</div>


@endsection

@section('css')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section("js")

<script>
const categorias = @json($categorias);

console.log(categorias)

let lista_categorias = [];
let datos = []

categorias.forEach(cat => {
    lista_categorias.push(cat.nombre);
    datos.push(cat.productos.length)
});

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
      labels: lista_categorias,
      datasets: [{
        label: '# Cantidad Productos',
        data: datos,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  const ctx2 = document.getElementById('myChart2');

new Chart(ctx2, {
    type: 'line',
    data: {
      labels: lista_categorias,
      datasets: [{
        label: '# Cantidad Productos',
        data: datos,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  
</script>

@stop