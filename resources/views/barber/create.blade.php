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
        <div>Barbería</div>
      </div>
    <div class="row">
        <div class="col-10 card-info">
          <p class="subtitule">Información de barbería</p>
            <form class="form-horizontal" method="POST" action="{{route('barber.save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                  <!-- Name -->
                  <div class="col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}" name="name"
                        value="{{ old('name') }}" placeholder="Nombre de la barbería" required autofocus>
                  </div>
                  <!--Image -->
                  <div class="col-md-2 offset-1">
                    <label for="image_path" class="form-control">Imagen</label>
                  </div>
                  <div class="col-md-3 col-form-label">
                    <input type="file" name="image_path"
                        class="file-input {{$errors->has('image_path') ? 'is-invalid' : ''}}">
                    @error('image_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <!--Address-->
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('addressname') ? ' has-error' : '' }}">
                      <input id="addressname" type="text" class="form-control {{ $errors->has('addressname') ? ' border-danger' : '' }}" name="addressname"
                        value="{{ old('addressname') }}" placeholder="Nombre de calle"required>
                  </div>
                  <div class="col-md-4 offset-md-1 {{ $errors->has('addressnum') ? ' has-error' : '' }}">
                      <input id="addressnum" type="text" class="form-control {{ $errors->has('addressnum') ? ' border-danger' : '' }}" name="addressnum"
                        value="{{ old('addressnum') }}" placeholder="Número" required>
                  </div>
                </div>
                <!--City & location -->
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('location') ? ' has-error' : '' }}">
                      <input id="location" type="text" class="form-control {{ $errors->has('location') ? ' border-danger' : '' }}" name="location"
                        value="{{ old('location') }}" placeholder="Localidad" required>
                  </div>
                  <div class="col-md-4 offset-md-1{{ $errors->has('city') ? ' has-error' : '' }}">
                      <input id="city" type="text" class="form-control {{ $errors->has('city') ? ' border-danger' : '' }}" name="city"
                        value="{{ old('city') }}" placeholder="Ciudad" required>
                  </div>
                </div>
                <!--Phone and zip -->
                <div class="form-group row">
                    <div class="col-md-4  {{ $errors->has('zip') ? ' has-error' : '' }}">
                        <input id="zip" type="text" class="form-control {{ $errors->has('zip') ? ' border-danger' : '' }}" name="zip"
                          value="{{ old('zip') }}" placeholder="C.P." required>
                    </div>
                  <div class="col-md-4 offset-md-1  {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? ' border-danger' : '' }}" name="phone"
                        value="{{ old('phone') }}" placeholder="Telefono" required>
                  </div>
                </div>
                <!--Schedule-->
                <div class="form-group row">
                  <div class="col-md-2">
                    <label for="time_start" class="form-control">Apertura</label>
                  </div>
                  <div class="col-md-2  {{ $errors->has('time_start') ? ' has-error' : '' }}">
                      <input id="time_start" type="time" class="form-control {{ $errors->has('time_start') ? ' border-danger' : '' }}" name="time_start" required>
                  </div>
                  <div class="col-md-2 offset-1">
                    <label for="time_end" class="form-control">Cierre</label>
                  </div>
                    <div class="col-md-2  {{ $errors->has('time_end') ? ' has-error' : '' }}">
                        <input id="time_end" type="time" class="form-control {{ $errors->has('end') ? ' border-danger' : '' }}" name="time_end" required>
                    </div>
                </div>


                <!-- buttons -->
                <div class="form-group row">
                    <div class="col-md-2">
                      <a  class="btn btn-info btn-block" href="/">Volver</a>
                    </div>
                    <div class="col-md-2 offset-md-5 mt-2">
                      <button type="submit" class="btn btn-success btn-block">Crear</button>
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
