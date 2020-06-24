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
        <div>Editar Barbería</div>
      </div>
    <div class="row">
        <div class="col-8">
          <p class="subtitule">Información de barbería</p>
            <form class="form-horizontal" method="POST" action="{{route('barber.update')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- name -->
                <div class="form-group row">
                  <div class="col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <input id="name" title="Nombre" type="text" class="form-control {{ $errors->has('name') ? ' border-danger' : '' }}" name="name"
                        placeholder="Nombre de la barbería" value="{{$user->barber->name}}" required autofocus>
                  </div>
                </div>
                <!--Ubications-->
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('location') ? ' has-error' : '' }}">
                      <input id="location" type="text" title="Localidad" class="form-control {{ $errors->has('location') ? ' border-danger' : '' }}" name="location"
                        value="{{$user->barber->location->location}}" placeholder="Localidad" required>
                  </div>
                  <div class="col-md-4 {{ $errors->has('city') ? ' has-error' : '' }}">
                      <input id="city" type="text" title="Ciudad" class="form-control {{ $errors->has('city') ? ' border-danger' : '' }}" name="city"
                        value="{{$user->barber->location->city}}" placeholder="Ciudad" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('addressname') ? ' has-error' : '' }}">
                      <input id="addressname" type="text" title="Dirección" class="form-control {{ $errors->has('addressname') ? ' border-danger' : '' }}" name="addressname"
                        value="{{$user->barber->location->addressname}}" placeholder="Nombre de calle"required>
                  </div>
                  <div class="col-md-4  {{ $errors->has('addressnum') ? ' has-error' : '' }}">
                      <input id="addressnum" title="Número" type="text" class="form-control {{ $errors->has('addressnum') ? ' border-danger' : '' }}" name="addressnum"
                        value="{{$user->barber->location->addressnum}}" placeholder="Número" required>
                  </div>

                </div>
                <!--Phone and zip -->
                <div class="form-group row">
                    <div class="col-md-4  {{ $errors->has('zip') ? ' has-error' : '' }}">
                        <input id="zip" type="text" title="Código Postal" class="form-control {{ $errors->has('zip') ? ' border-danger' : '' }}" name="zip"
                          value="{{$user->barber->location->zip}}" placeholder="C.P." required>
                    </div>
                  <div class="col-md-4 col-offset-2  {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <input id="phone" type="text" title="Teléfono" class="form-control {{ $errors->has('phone') ? ' border-danger' : '' }}" name="phone"
                        value="{{$user->barber->phone}}" placeholder="Telefono" required>
                  </div>
                </div>
                <!--Schedule-->
                <div class="form-group row">
                  <div class="col-md-2">
                    <label for="time_start" class="form-control">Apertura</label>
                  </div>
                  <div class="col-md-2  {{ $errors->has('time_start') ? ' has-error' : '' }}">
                      <input id="time_start" type="time" class="form-control {{ $errors->has('time_start') ? ' border-danger' : '' }}" name="time_start"
                      value="{{$user->barber->schedule->init}}" required>
                  </div>
                  <div class="col-md-2">
                    <label for="time_end" class="form-control">Cierre</label>
                  </div>
                    <div class="col-md-2  {{ $errors->has('time_end') ? ' has-error' : '' }}">
                        <input id="time_end" type="time" class="form-control {{ $errors->has('end') ? ' border-danger' : '' }}" name="time_end"
                        value="{{$user->barber->schedule->end}}" required>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="image_path" class="form-control">Subir foto de barbería</label>
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
                      <button id="button-update" type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
          <br><br><br><br>
          <div class="card pub_image pub_image_detail">
              <div class="card-header bg-info">
                <p>Foto de la barbería</p>
              </div>
              <div class="card-body">
                <div class="image-container image-detail">
                  @if($user->barber->image)
                  <img src="{{route('barber.avatar',['filename'=>$user->barber->image])}}" >
                  @else
                  <img src="/img/empty_pic.png" alt="">
                  @endif
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
