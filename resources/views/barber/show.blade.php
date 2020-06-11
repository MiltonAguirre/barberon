@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  @if($barber)
    <div class="row">
      <div class="col-md-8">
        <div class="card border-info" >
          <div class="card-header bg-info">Información de la barbería</div>
          <div class="card-body">
            <!-- First and last name -->
            <div class="row">
              <div class="col-xs-5 col-md-4">
                <p>Nombre: <strong>{{$barber->name}}</strong></p>
              </div>
            </div>
            <!--Address -->
            <div class="row">
              <div class="col-xs-5 col-md-4">
                <p>Dirección: <strong>{{$barber->location->addressname}}</strong></p>
              </div>
              <div class="col-xs-5 col-md-4 offset-1">
                 <p>Nro.: <strong>{{$barber->location->addressnum}}</strong></p>
               </div>
            </div>
            <!--Location and city -->
            <div class="row">
              <div class="col-xs-5 col-md-4">
                <p>Ciudad: <strong>{{$barber->location->city}}</strong></p>
              </div>
              <div class="col-xs-5 col-md-4 offset-1">
                <p>Localidad: <strong>{{$barber->location->location}}</strong></p>
              </div>
            </div>
            <!--Phone and ZIP -->
            <div class="row">
              <div class="col-xs-5 col-md-4">
                <p>Teléfono: <strong>{{$barber->phone}}</strong></p>
              </div>
              <div class="col-xs-4 col-md-4 offset-1 ">
                <p>C.P.: <strong>{{$barber->location->zip}}</strong></p>
              </div>
            </div>
            <div class="row">
                <div class="col-sm-4 offset-xs-9 offset-sm-10">
                  <a  class="btn btn-info" href="/">Volver</a>
                </div>
            </div>
          </div>
        </div>
        <!-- button -->

      </div>
      <div class="col-4">
        <div class="card pub_image pub_image_detail">
            <div class="card-header bg-info">
              <p>Foto de la barbería</p>
            </div>
            <div class="card-body">
              <div class="image-container image-detail">
                @if($barber->image)
                <img src="{{route('barber.avatar',['filename'=>$barber->image])}}" >
                @else
                <img src="/img/empty_pic.png" alt="">
                @endif
              </div>
            </div>
        </div>
      </div>
    </div>
    <br><br>
    <a type="button" class="btn btn-primary btn-lg btn-block" href="/barber/products/{{$barber->id}}">Ver productos</a>

      @if(\Auth::user() && \Auth::user()->isBarber() && \Auth::user()->barber->id == $barber->id)
        <a type="button" class="btn btn-success btn-lg btn-block" href="{{route('product.create')}}">Agregar productos</a>
      @endif
  @else
    <div class="alert alert-danger">
      Usted no posee una barbería online, creela <a href="{{route('barber.create')}}">aquí</a>
    </div>
  @endif
</div>
@endsection
