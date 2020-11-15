@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  @if($barber)
    <div class="edithead">
      <div>Mi Barbería</div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card" >
          <div class="card-header color-secondary text-dark">Información de la barbería</div>
          <div class="card-body">
            <!-- Name -->
            <label>Nombre: <strong>{{$barber->name}}</strong></label>
            <hr class="color-secondary" />
            <!--Address -->
            <div class="row">
              <div class="col-md-6">
                <p>Calle: <strong>{{$barber->location->addressname}}</strong></p>
              </div>
              <div class="col-md-6">
                 <p>Nro.: <strong>{{$barber->location->addressnum}}</strong></p>
               </div>
            </div>
            <!--Location and city -->
            <div class="row">
              <div class="col-md-6">
                <p>Ciudad: <strong>{{$barber->location->city}}</strong></p>
              </div>
              <div class="col-md-6">
                <p>Localidad: <strong>{{$barber->location->location}}</strong></p>
              </div>
            </div>
            <!--Phone and ZIP -->
            <div class="row">
              <div class="col-md-6">
                <p>Teléfono: <strong>{{$barber->phone}}</strong></p>
              </div>
              <div class="col-md-6">
                <p>C.P.: <strong>{{$barber->location->zip}}</strong></p>
              </div>
            </div>
            <hr class="color-secondary" />
            <!--Phone and ZIP -->
            <div class="row">
              <div class="col-md-6">
                <p>Apertura: <strong>{{$barber->schedule->init}}</strong></p>
              </div>
              <div class="col-md-6">
                <p>Cierrre: <strong>{{$barber->schedule->end}}</strong></p>
              </div>
            </div>
            <br/>

            <!-- button -->
            <div class="row">
                <div class="offset-8 offset-md-9 offset-lg-10">
                  <a  class="btn btn-info" href="/">Ir a inicio</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card pub_image pub_image_detail">
            <div class="card-header color-secondary text-dark">
              <p>Foto de la barbería</p>
            </div>
            <div class="card-body mt-2">
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
