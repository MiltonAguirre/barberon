@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  <div class="edithead">
    <div>Mi perfíl</div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card" >
        <div class="card-header color-secondary text-dark">Información del usuario</div>
        <div class="card-body">
          <!-- First and last name -->
          <div class="row">
            <div class="col-md-6">
              <p>Nombre: <strong>{{$user->dataUser->first_name}}</strong></p>
            </div>
            <div class="col-md-6">
              <p>Apellido: <strong>{{$user->dataUser->last_name}}</strong></p>
            </div>
          </div>
          <hr class="color-secondary"/>
          <!--Address -->
          <div class="row">
            <div class="col-md-6">
              <p>Dirección: <strong>{{$user->location->addressname}}</strong></p>
            </div>
            <div class="col-md-6">
               <p>Nro.: <strong>{{$user->location->addressnum}}</strong></p>
             </div>
          </div>
          <!--Location and city -->
          <div class="row">
            <div class="col-md-6">
              <p>Ciudad: <strong>{{$user->location->city}}</strong></p>
            </div>
            <div class="col-md-6">
              <p>Localidad: <strong>{{$user->location->location}}</strong></p>
            </div>
          </div>
          <!--Phone and ZIP -->
          <div class="row">
            <div class="col-md-6">
              <p>Teléfono: <strong>{{$user->dataUser->phone}}</strong></p>
            </div>
            <div class="col-md-6">
              <p>C.P.: <strong>{{$user->location->zip}}</strong></p>
            </div>
          </div>
          <hr class="color-secondary"/>
          <!--Username and Email -->
          <div class="row">
            <div class="col-md-6">
              <p>Usuario: <strong>{{$user->username}}</strong></p>
            </div>
            <div class="col-md-6">
              <p>Email: <strong>{{$user->dataUser->email}}</strong></p>
            </div>
          </div>
          <br/>
          <!--Role-->
          <div class="row">
            <div class="form-group col-md-5 ml-2 color-secondary rol-content">
              <label class="rol-user">Rol de usuario: {{$user->getRole()}}</label>
            </div>
          </div>

          <!-- button -->
          <div class="row">
              <div class="offset-8 offset-md-9 offset-lg-10">
                <a  class="btn btn-info" href="/">Ir a inicio</a>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card pub_image pub_image_detail">
          <div class="card-header color-secondary text-dark">
            <p>Imagen de perfíl</p>
          </div>
          <div class="card-body mt-2">
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
