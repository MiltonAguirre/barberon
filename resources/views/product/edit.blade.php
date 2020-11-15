@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container col-6">
        @if ($errors->any())
        <br>
            <div class="alert alert-danger">
              <div class="panel-heading">Se han encontrado algunos errores</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="edithead">
        <div>Editar el producto</div>
      </div>
    <div class="row">
      <div class="col-8 card">
        <div class="card-header color-secondary text-dark">
          Información del producto
        </div>
        <div class="card-body pl-5 mt-3 ">
          <form class="form-horizontal" method="POST" action="/barber/product/upddate/{{$product->id}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <div class="col-md-11 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}"
                              type="text" name="name" placeholder="Nombre del producto"
                              value="{{$product->name}}" required autofocus>
                  </div>
                </div>
                <!--Description-->
                <div class="form-group row">
                  <div class="col-md-11 {{ $errors->has('description') ? ' has-error' : '' }}">
                    <textarea class="form-control {{ $errors->has('description') ? ' border-danger' : '' }}"
                      name="description" rows="3" cols="70" placeholder="Descripción del producto"
                      required>{{$product->description}}</textarea>
                  </div>
                </div>
                <!--Price and delay-->
                <div class="form-group row">
                  <div class="col-md-5  {{ $errors->has('price') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('price') ? ' border-danger' : '' }}"
                              type="text" name="price" placeholder="Precio" value="{{$product->price}}" required>
                  </div>
                  <div class="col-md-5 offset-1{{ $errors->has('delay') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('delay') ? ' border-danger' : '' }}"
                              type="text" name="delay" placeholder="Tiempo de demora"
                              value="{{$product->delay}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-5">
                    <label for="image_path" class="form-control">Imagen del producto</label>
                  </div>
                  <div class="col-md-5 offset-1">
                    <input  class="form-control @error('image_path') is-invalid @enderror"
                            type="file" name="image_path">
                  </div>
                </div>

                <!-- buttons -->
                <div class="form-group row">
                    <div class="col-md-3">
                      <a  class="btn btn-info btn-block" href="/user/barber/show">Cancelar</a>
                    </div>
                    <div class="col-md-3 offset-5">
                      <button id="button-update" type="submit" class="btn btn-success btn-block">Actualizar</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
        <div class="col-md-3 card mx-3 ">
          <div class="image-container image-detail">
            <img src="{{route('product.avatar',['filename'=>$product->image])}}">
            <div class="card-body">
              <h5>{{$product->name}}</h5>
              <hr class="color-secondary">
              <div class="row pb-3">
                <div class="col-6 text-center">
                  <div><b>${{$product->price}}</b></div>
                  <div><label>Precio</label></div>
                </div>
                <div class="col-6 text-center">
                  <div><b>{{$product->delay}} min</b></div>
                  <div><label>Tiempo</label></div>
                </div>
              </div>
              <div class="row justify-content-center">
                <p>{{$product->description}}</p>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
@endsection
