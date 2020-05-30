@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  @if($user->barber)
  <div class="row">
    <div class="col-md-8">
      <div class="card border-info" >
        <div class="card-header bg-info">Información de la barbería</div>
        <div class="card-body">
          <!-- First and last name -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Nombre: <strong>{{$user->barber->name}}</strong></p>
            </div>
          </div>
          <!--Address -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Dirección: <strong>{{$user->barber->location->addressname}}</strong></p>
            </div>
            <div class="col-xs-5 col-md-4">
               <p>Nro.: <strong>{{$user->barber->location->addressnum}}</strong></p>
             </div>
          </div>
          <!--Location and city -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Ciudad: <strong>{{$user->barber->location->city}}</strong></p>
            </div>
            <div class="col-xs-5 col-md-4">
              <p>Localidad: <strong>{{$user->barber->location->location}}</strong></p>
            </div>
          </div>
          <!--Phone and ZIP -->
          <div class="row">
            <div class="col-xs-5 col-md-4">
              <p>Teléfono: <strong>{{$user->barber->phone}}</strong></p>
            </div>
            <div class="col-xs-4 col-md-4 col-offset-2 ">
              <p>C.P.: <strong>{{$user->barber->location->zip}}</strong></p>
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
  @else
  <div class="alert alert-danger">
    Usted no posee una barbería online, creela <a href="{{route('barber.create')}}">aquí</a>
  </div>
  @endif
</div>
@endsection
