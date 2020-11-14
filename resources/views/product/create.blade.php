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
      <div class="edithead ml-3">
        <div>Agregar un nuevo producto</div>
      </div>
    <div class="container">
        <div class="col-8 card-info">
          <p class="subtitule">Información del producto</p>
            <form class="form-horizontal" method="POST" action="{{route('product.new')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <div class="col-md-11 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}"
                        id="name" title="Nombre" type="text" name="name"
                        placeholder="Nombre del producto" required autofocus>
                  </div>
                </div>

                <!--Description-->
                <div class="form-group row">
                  <div class="col-md-11 {{ $errors->has('description') ? ' has-error' : '' }}">
                    <textarea class="form-control {{ $errors->has('description') ? ' border-danger' : '' }}"
                      name="description" rows="3" cols="70"
                      placeholder="Descripción del producto" required></textarea>
                  </div>
                </div>
                <!--Price & Delay-->
                <div class="form-group row">
                  <div class="col-md-5  {{ $errors->has('price') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('price') ? ' border-danger' : '' }}"
                        id="price" type="text" title="Precio" name="price"
                        placeholder="Precio" required>
                  </div>
                  <div class="col-md-5 offset-1{{ $errors->has('delay') ? ' has-error' : '' }}">
                      <input class="form-control {{ $errors->has('delay') ? ' border-danger' : '' }}"
                        id="delay" type="text" title="Demora" name="delay"
                        placeholder="Tiempo de demora" required>
                  </div>
                </div>
                <!--Image-->
                <div class="form-group row">
                  <div class="col-md-5">
                    <label for="image_path" class="form-control">Imagen del producto:</label>
                  </div>
                  <div class="col-md-5 offset-1">
                    <input class="form-control @error('image_path') is-invalid @enderror"
                      id="image_path" type="file" name="image_path">
                    @error('image_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                </div>
                <!-- buttons -->
                <div class="form-group row mt-5">
                    <div class="col-md-3  mr-5">
                      <a  class="btn btn-info btn-block" href="/">Ir a inicio</a>
                    </div>
                    <div class="col-md-3 offset-4">
                      <button id="button-update" type="submit" class="btn btn-success btn-block">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
@endsection
