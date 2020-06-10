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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#turnModal">
                  Turno
                </button>
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

<!-- Modal -->
<div class="modal fade" id="turnModal" tabindex="-1" role="dialog" aria-labelledby="turnModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="turnModalLabel">Obten un turno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" method="post" action="/user/product/turn/{{$product->id}}">
          <div class="form-group">
            <label for="dateTurn">Selecciona la fecha deseada:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="date" name="dateTurn" min="2020-06-01" max="2518-05-25" step="1" required>
          </div>
          <div class="form-group">
            <label for="timeTurn">Selecciona la hora deseada:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="time" name="timeTurn" min="08:00" max="21:00" step="1800" required>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Obtener">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection
