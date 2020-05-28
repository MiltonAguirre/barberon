@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container col-6">
        @if ($errors->any())
        <br>
            <div class="alert alert-danger">
              <div class="panel-heading">Errores ingresados</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>

    <div class="row">
        <div class="col-6">
            <div class="card border-info" >
                <div class="card-header bg-info">Registro de usuario</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
<!-- NAME AND SURNAME-->
                        <div class="form-group row">
                              <div class="col-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                  <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' border-danger' : '' }}" name="first_name"
                                   value="{{ old('first_name') }}" placeholder="Nombre" required autofocus>
                              </div>
                              <div class="col-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                  <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' border-danger' : '' }}" name="last_name"
                                   value="{{ old('last_name') }}" placeholder="Apellido" required>
                              </div>
                        </div>
<!--EMAIL AND USERNAME -->
                        <div class="form-group row">
                            <div class="col-6 {{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' border-danger' : '' }}" name="username"
                                 value="{{ old('username') }}" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="col-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' border-danger' : '' }}" name="email"
                                 value="{{ old('email') }}" placeholder="Correo electrónico" required>
                            </div>
                        </div>
<!-- UBICATIONS-->
                        <div class="form-group row">
                          <div class="col-6  {{ $errors->has('location') ? ' has-error' : '' }}">
                              <input id="location" type="text" class="form-control {{ $errors->has('location') ? ' border-danger' : '' }}" name="location"
                              value="{{ old('location') }}" placeholder="Localidad" required>
                          </div>
                          <div class="col-6 {{ $errors->has('city') ? ' has-error' : '' }}">
                              <input id="city" type="text" class="form-control {{ $errors->has('city') ? ' border-danger' : '' }}" name="city"
                              value="{{ old('city') }}" placeholder="Ciudad" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-6  {{ $errors->has('addressname') ? ' has-error' : '' }}">
                              <input id="addressname" type="text" class="form-control {{ $errors->has('addressname') ? ' border-danger' : '' }}" name="addressname"
                               value="{{ old('addressname') }}" placeholder="Nombre de calle" required>
                          </div>
                          <div class="col-3  {{ $errors->has('addressnum') ? ' has-error' : '' }}">
                              <input id="addressnum" type="text" class="form-control {{ $errors->has('addressnum') ? ' border-danger' : '' }}" name="addressnum"
                              value="{{ old('addressnum') }}" placeholder="Número" required>
                          </div>

                        </div>
<!--PHONE AND ZIP -->
                        <div class="form-group row">
                          <div class="col-4 {{ $errors->has('phone') ? ' has-error' : '' }}">
                              <input id="phone" type="text" class="form-control  {{ $errors->has('phone') ? ' border-danger' : '' }}" name="phone"
                              value="{{ old('phone') }}" placeholder="Telefono" required>
                          </div>
                          <div class="col-4 {{ $errors->has('zip') ? ' has-error' : '' }}">
                            <input id="zip" type="text" class="form-control  {{ $errors->has('zip') ? ' border-danger' : '' }}" name="zip"
                             value="{{ old('zip') }}" placeholder="C.P." required>
                          </div>
                          <div class="form-group col-4">
                            <div class="  {{ $errors->has('rol') ? ' has-error' : '' }}">
                            <select name="rol" class="form-control selcls  {{ $errors->has('rol') ? ' border-danger' : '' }}" id="rol">
                              <option value="" selected disabled hidden>Rol del usuario</option>
                              <option value="1">Cliente</option>
                              <option value="2">Barbero</option>
                            </select>
                            </div>
                          </div>
                        </div>
<!-- REGISTER BUTTON-->
                        <div class="form-group row">
                            <div class="col-2 offset-6 ">
                              <a  class="btn btn-info" href="/">Cancelar</a>
                            </div>
                            <div class="col-2 offset-1">
                                <button type="submit" class="btn btn-success">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
