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
        <div>Editar mi perfíl</div>
      </div>
    <div class="row">
        <div class="col-10 card">
          <div class="card-header color-secondary text-dark">Información del usuario</div>
          <div class="card-body pl-5">

            <form class="form-horizontal" method="POST" action="{{route('user.save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!--Role-->
                <div class="form-group col-4 color-secondary rol-content">
                  <label class="rol-user">Rol de usuario: {{$user->getRole()}}</label>
                </div>
                <!-- First y last name -->
                <div class="form-group row">
                      <div class="col-md-5 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <input id="first_name" title="Nombre" type="text" class="form-control {{ $errors->has('first_name') ? ' border-danger' : '' }}" name="first_name"
                           value="{{ $user->dataUser->first_name }}" placeholder="Nombre" required autofocus>
                      </div>
                      <div class="col-md-5 offset-md-1{{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <input id="last_name" title="Apellido" type="text" class="form-control {{ $errors->has('last_name') ? ' border-danger' : '' }}" name="last_name"
                           value='{{$user->dataUser->last_name}}'placeholder="Apellido" required autofocus>
                      </div>
                </div>
                <!--Email and Username -->
                <div class="form-group row">
                    <div class="col-md-5 {{ $errors->has('username') ? ' has-error' : '' }}">
                        <input id="username" type="text" title="Nombre de usuario" class="form-control {{ $errors->has('username') ? ' border-danger' : '' }}" name="username"
                         value="{{$user->username}}" placeholder="Nombre de usuario" required autofocus disabled>
                    </div>
                    <div class="col-md-5 offset-md-1{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" title="Email" class="form-control {{ $errors->has('email') ? ' border-danger' : '' }}" name="email"
                         value="{{ $user->dataUser->email}}" placeholder="Correo electrónico"required disabled>
                    </div>
                </div>
                <!--Ubications-->
                <div class="form-group row">
                  <div class="col-md-5  {{ $errors->has('location') ? ' has-error' : '' }}">
                      <input id="location" type="text" title="Localidad" class="form-control {{ $errors->has('location') ? ' border-danger' : '' }}" name="location"
                      value="{{ $user->location->location }}" placeholder="Localidad" required>
                  </div>
                  <div class="col-md-5 offset-md-1{{ $errors->has('city') ? ' has-error' : '' }}">
                      <input id="city" type="text" title="Ciudad" class="form-control {{ $errors->has('city') ? ' border-danger' : '' }}" name="city"
                      value="{{$user->location->city}}" placeholder="Ciudad" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-5  {{ $errors->has('addressname') ? ' has-error' : '' }}">
                      <input id="addressname" type="text" title="Dirección" class="form-control {{ $errors->has('addressname') ? ' border-danger' : '' }}" name="addressname"
                       value="{{ $user->location->addressname}}" placeholder="Nombre de calle"required>
                  </div>
                  <div class="col-md-5 offset-md-1 {{ $errors->has('addressnum') ? ' has-error' : '' }}">
                      <input id="addressnum" title="Número" type="text" class="form-control {{ $errors->has('addressnum') ? ' border-danger' : '' }}" name="addressnum"
                      value="{{$user->location->addressnum}}" placeholder="Número" required>
                  </div>

                </div>
                <!--Phone and zip -->
                <div class="form-group row">
                    <div class="col-md-5  {{ $errors->has('zip') ? ' has-error' : '' }}">
                        <input id="zip" type="text" title="Código Postal" class="form-control {{ $errors->has('zip') ? ' border-danger' : '' }}" name="zip"
                         value="{{$user->location->zip}}" placeholder="C.P." required>
                    </div>
                  <div class="col-md-5 offset-md-1 {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <input id="phone" type="text" title="Teléfono" class="form-control {{ $errors->has('phone') ? ' border-danger' : '' }}" name="phone"
                      value="{{ $user->dataUser->phone }}" placeholder="Telefono" required>
                  </div>
                </div>

                <!-- buttons -->
                <div class="form-group row mt-5">
                    <div class="col-md-3 ">
                      <a  class="btn btn-info btn-block" href="/">Volver</a>
                    </div>
                    <div class="col-md-3 offset-md-5">
                      <button type="submit" class="btn btn-success btn-block">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
      </div>

    </div>
</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
@endsection
