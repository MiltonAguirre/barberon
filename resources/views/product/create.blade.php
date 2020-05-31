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
        <div>Agregar un nuevo producto</div>
      </div>
    <div class="row">
        <div class="col-8">
          <p class="subtitule">Información del producto</p>
            <form class="form-horizontal" method="POST" action="{{route('product.new')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <div class="col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <input id="name" title="Nombre" type="text" class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}" name="name"
                        placeholder="Nombre del producto" required autofocus>
                  </div>
                </div>
                <!--Price and delay-->
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('price') ? ' has-error' : '' }}">
                      <input id="price" type="text" title="Precio" class="form-control {{ $errors->has('price') ? ' border-danger' : '' }}" name="price"
                        placeholder="Precio" required>
                  </div>
                  <div class="col-md-4 {{ $errors->has('delay') ? ' has-error' : '' }}">
                      <input id="delay" type="text" title="Demora" class="form-control {{ $errors->has('delay') ? ' border-danger' : '' }}" name="delay"
                        placeholder="Tiempo de demora" required>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="image_path" class="form-control">Subir foto del producto</label>
                  </div>
                  <div class="col-md-4">
                    <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path">
                    @error('image_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <!-- buttons -->
                <div class="form-group row">
                    <div class="col-md-4">
                      <a  class="btn btn-info" href="/">Volver</a>
                    </div>
                    <div class="col-md-4">
                      <button id="button-update" type="submit" class="btn btn-success">Crear</button>
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
