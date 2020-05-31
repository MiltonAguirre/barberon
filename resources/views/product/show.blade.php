@extends('layouts.app')

@section('content')
<div class="container">
  <header class="masthead">
    <div class="masthead-subheading">Productos de la barberia</div>
  </header>
  @foreach($products as $product)
  <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$product->name}}</h5>
      <p class="card-text">Precio: {{$product->price}}</p>
      <p class="card-text">Tiempo estimado: {{$product->delay}}</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
  @endforeach
</div>
@endsection
