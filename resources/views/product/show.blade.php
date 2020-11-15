@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')

  <div class="card px-5 justify-content-center">
    <div class="row">
      <div class="col-8">
        <h3 class="edithead">Productos de la barbería</h3>
      </div>
      <div class="col-2 offset-2 goBack">
        <a class="btn btn-info btn-block" href="/barber/show/{{$products[0]->barber->id}}">Volver</a>
      </div>
    </div>
    <br>
    <div class="row justify-content-center">
      <?php $i=0 ?>
      @foreach($products as $product)
      <div class="col-md-3 card-product py-1 mx-3">
        <div class="image-container image-detail">
          <img src="{{route('product.avatar',['filename'=>$product->image])}}">
          <div class="card-body">
            <h5>{{$product->name}}</h5>
            <hr class="color-secondary">
            <div class="row pb-3">
              <div class="col-6 text-center">
                <div>
                  <b>${{$product->price}}</b>
                </div>
                <div>
                  <label>Precio</label>
                </div>
              </div>
              <div class="col-6 text-center">
                <div>
                  <b>{{$product->delay}} min</b>
                </div>
                <div>
                  <label>Tiempo</label>
                </div>
              </div>
            </div>
            <!-- Button trigger modal -->
            <div class="row">
              @if(\Auth::user()->isBarber() && \Auth::user()->barber->id == $product->barber_id)
              <div class="col-md-6">
                <a href="/barber/product/edit/{{$product->id}}" class="btn btn-info btn-block">Editar</a>
              </div>
              <div class="col-md-6">
                <form action="/barber/product/delete/{{$product->id}}" method="POST">
                  <input type="hidden" name="_method" value="delete" />
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input class="btn btn-danger a-btn-slide-text btn-block" type="submit" value="Borrar" />
                </form>
              </div>

              @else
              <div class="col-md-6 offset-6">
                <a type="button" class="btn btn-primary btn-block" href="/user/turn/create/{{$product->id}}">
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
        echo "</div><br><div class='row justify-content-center'>";
      }
      ?>
      @endforeach
    </div>
  </div>
</div>
@endsection
