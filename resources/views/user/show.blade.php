@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card border-info" >
        <div class="card-header bg-info">Información del usuario</div>
        <div class="card-body">
          <!-- First and last name -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Nombre: <strong>{{$user->dataUser->first_name}}</strong></p>
            </div>
            <div class="col-xs-5 col-md-4">
              <p>Apellido: <strong>{{$user->dataUser->last_name}}</strong></p>
            </div>
          </div>
          <!--Email and Username -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Usuario: <strong>{{$user->username}}</strong></p>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-4">
              <p>Email: <strong>{{$user->dataUser->email}}</strong></p>
            </div>
          </div>
          <!--Address -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Dirección: <strong>{{$user->location->addressname}}</strong></p>
            </div>
            <div class="col-xs-5 col-md-4">
               <p>Nro.: <strong>{{$user->location->addressnum}}</strong></p>
             </div>
          </div>
          <!--Location and city -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Ciudad: <strong>{{$user->location->city}}</strong></p>
            </div>
            <div class="col-xs-5 col-md-4">
              <p>Localidad: <strong>{{$user->location->location}}</strong></p>
            </div>
          </div>
          <!--Phone and ZIP -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Teléfono: <strong>{{$user->dataUser->phone}}</strong></p>
            </div>
            <div class="col-xs-4 col-md-4 col-offset-2 ">
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
    <div class="col-4">
      <div class="card pub_image pub_image_detail">
          <div class="card-header bg-info">
            <p>Imagen de perfíl</p>
          </div>
          <div class="card-body">
            <div class="image-container image-detail">
              @if($user->image)
              <img src="{{route('user.avatar',['filename'=>$user->image->image_path])}}" >
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
