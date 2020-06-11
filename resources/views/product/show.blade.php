@extends('layouts.app')

@section('content')
<div class="container">

    @include('includes.message')
    <div class="offset-md-11">
      <a class="btn btn-info" href="/barber/show/{{$products[0]->barber->id}}">Volver</a>
    </div>

  <div class="products">
      <h3 class="edithead">Productos de la barbería</h3>
      <br><br>
    <div class="row">
      <?php $i=0 ?>
      @foreach($products as $product)
      <div class="col-md-4 product">
        <div class="card">
          <img class="card-img-top" src="{{route('product.avatar',['filename'=>$product->image])}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <p class="card-text">Precio: ${{$product->price}}</p>
            <p class="card-text">Tiempo estimado: {{$product->delay}} minutos</p>
            <!-- Button trigger modal -->
            <div class="row">
              @if(\Auth::user()->isBarber() && \Auth::user()->barber->id == $product->barber_id)
              <div class="col-md-2 offset-md-5">
                <a href="/barber/product/edit/{{$product->id}}" class="btn btn-info">Editar</a>
              </div>
              <div class="col-md-2 offset-md-1">
                <form action="/barber/product/delete/{{$product->id}}" method="POST">
                  <input type="hidden" name="_method" value="delete" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input class="btn btn-danger a-btn-slide-text" type="submit" value="Borrar" />
                </form>
              </div>

              @else
              <div class="col-md-2 offset-8">
                <a type="button" class="btn btn-primary" href="/user/product/create/turn/{{$product->id}}">
                  Turno
                </a>
              </div>

              @endif
            </div>

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
