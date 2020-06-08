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
        <div>Edición de perfíl</div>
      </div>
    <div class="row">
        <div class="col-8">
          <p class="subtitule">Información de usuario</p>
            <form class="form-horizontal" method="POST" action="{{route('user.save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!-- First y last name -->
                <div class="form-group row">
                      <div class="col-md-4 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <input id="first_name" title="Nombre" type="text" class="form-control {{ $errors->has('first_name') ? ' border-danger' : '' }}" name="first_name"
                           value="{{ $user->dataUser->first_name }}" placeholder="Nombre" required autofocus>
                      </div>
                      <div class="col-md-4 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <input id="last_name" title="Apellido" type="text" class="form-control {{ $errors->has('last_name') ? ' border-danger' : '' }}" name="last_name"
                           value='{{$user->dataUser->last_name}}'placeholder="Apellido" required autofocus>
                      </div>
                </div>
                <!--Email and Username -->
                <div class="form-group row">
                    <div class="col-md-4 {{ $errors->has('username') ? ' has-error' : '' }}">
                        <input id="username" type="text" title="Nombre de usuario" class="form-control {{ $errors->has('username') ? ' border-danger' : '' }}" name="username"
                         value="{{$user->username}}" placeholder="Nombre de usuario" required autofocus disabled>
                    </div>
                    <div class="col-md-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" title="Email" class="form-control {{ $errors->has('email') ? ' border-danger' : '' }}" name="email"
                         value="{{ $user->dataUser->email}}" placeholder="Correo electrónico"required disabled>
                    </div>
                </div>
                <!--Ubications-->
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('location') ? ' has-error' : '' }}">
                      <input id="location" type="text" title="Localidad" class="form-control {{ $errors->has('location') ? ' border-danger' : '' }}" name="location"
                      value="{{ $user->location->location }}" placeholder="Localidad" required>
                  </div>
                  <div class="col-md-4 {{ $errors->has('city') ? ' has-error' : '' }}">
                      <input id="city" type="text" title="Ciudad" class="form-control {{ $errors->has('city') ? ' border-danger' : '' }}" name="city"
                      value="{{$user->location->city}}" placeholder="Ciudad" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4  {{ $errors->has('addressname') ? ' has-error' : '' }}">
                      <input id="addressname" type="text" title="Dirección" class="form-control {{ $errors->has('addressname') ? ' border-danger' : '' }}" name="addressname"
                       value="{{ $user->location->addressname}}" placeholder="Nombre de calle"required>
                  </div>
                  <div class="col-md-4  {{ $errors->has('addressnum') ? ' has-error' : '' }}">
                      <input id="addressnum" title="Número" type="text" class="form-control {{ $errors->has('addressnum') ? ' border-danger' : '' }}" name="addressnum"
                      value="{{$user->location->addressnum}}" placeholder="Número" required>
                  </div>

                </div>
                <!--Phone and zip -->
                <div class="form-group row">
                    <div class="col-md-4  {{ $errors->has('zip') ? ' has-error' : '' }}">
                        <input id="zip" type="text" title="Código Postal" class="form-control {{ $errors->has('zip') ? ' border-danger' : '' }}" name="zip"
                         value="{{$user->location->zip}}" placeholder="C.P." required>
                    </div>
                  <div class="col-md-4 col-offset-2  {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <input id="phone" type="text" title="Teléfono" class="form-control {{ $errors->has('phone') ? ' border-danger' : '' }}" name="phone"
                      value="{{ $user->dataUser->phone }}" placeholder="Telefono" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="role" class="form-control">Role de usuario: </label>
                  </div>
                  <div class="col-md-4">
                    <label class="form-control">{{$user->getRole()}}</label>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4">
                    <label for="image_path" class="form-control">Cambiar foto</label>
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
                    <div class="col-md-2">
                      <a  class="btn btn-info" href="/">Volver</a>
                    </div>
                    <div class="col-md-2 offset-md-4">
                      <button id="button-update" type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
          <br><br><br><br>
          <div class="card pub_image pub_image_detail">
              <div class="card-header bg-info">
                <p>Imagen de perfíl</p>
              </div>
              <div class="card-body">
                <div class="image-container image-detail">
                  @if($user->image)
                  <img src="{{route('user.avatar',['filename'=>$user->image])}}" >
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
