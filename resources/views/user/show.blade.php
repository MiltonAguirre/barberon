@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-9 col-md-offset-2">
    <div class="card border-info" >
      <div class="card-header bg-info">Información del usuario</div>
      <div class="card-body">
        <!-- First and last name -->
        <div class="row">
          <div class="col-xs-5">
            <p>Nombre: <strong>{{$user->dataUser->first_name}}</strong></p>
          </div>
          <div class="col-xs-5">
            <p>Apellido: <strong>{{$user->dataUser->last_name}}</strong></p>
          </div>
        </div>
        <!--Email and Username -->
        <div class="row">
          <div class="col-xs-5">
            <p>Usuario: <strong>{{$user->username}}</strong></p>
          </div>
          <div class="col-xs-5 col-sm-5">
            <p>Email: <strong>{{$user->dataUser->email}}</strong></p>
          </div>
        </div>
        <!--Address -->
        <div class="row">
          <div class="col-xs-5">
            <p>Dirección: <strong>{{$user->location->addressname}}</strong></p>
          </div>
          <div class="col-xs-5">
             <p>Nro.: <strong>{{$user->location->addressnum}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Piso: <strong>{{empty($user->location->addressfloor) ? '-' : $user->location->addressfloor}} </strong></p>
           </div>
        </div>
        <!--Location and city -->
        <div class="row">
          <div class="col-xs-5">
            <p>Ciudad: <strong>{{$user->location->city}}</strong></p>
          </div>
          <div class="col-xs-5">
            <p>Localidad: <strong>{{$user->location->location}}</strong></p>
          </div>
        </div>
        <!--Phone and ZIP -->
        <div class="row">
          <div class="col-xs-5">
            <p>Teléfono: <strong>{{$user->dataUser->phone}}</strong></p>
          </div>
          <div class="col-xs-4">
            <p>C.P.: <strong>{{$user->location->zip}}</strong></p>
          </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-sm-4 col-xs-offset-9 col-sm-offset-10">
              <a  class="btn btn-info" href="/">Volver</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
