@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-info" href="/barber/show/{{$products[0]->barber->id}}">Volver</a>


  <div class="products">
      <h3 class="edithead">Productos de la barberia</h3>
    <div class="row">
      <?php $i=0 ?>
      @foreach($products as $product)
      <div class="col-md-4 product">
        <div class="card">
          <img class="card-img-top" src="{{route('product.avatar',['filename'=>$product->image])}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">Precio: {{$product->price}}</p>
            <p class="card-text">Tiempo estimado: {{$product->delay}}</p>
            <a href="#" class="btn btn-primary">Obtener turno</a>
          </div>
        </div>
      </div>
      <?php $i++ ;
      if($i==3){
        $i=0;
        echo "</div><br><div class='row'>";
      }
      ?>
      @endforeach
    </div>
  </div>
</div>
@endsection
