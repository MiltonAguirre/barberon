@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  <header class="masthead">
      <div class="container">
        <div class="masthead-heading">Bienvenido a BarberON</div>
          <div class="masthead-subheading">Buscá tu barbería favorita y obtené tu turno</div>
          <div class="card-info">
            <form class="form-inline pt-4" method="POST" action="{{route('search')}}">
              {{ csrf_field() }}
                <input type="text" class="form-control col-6 offset-2" size="50" name="name" placeholder="Nombre de la barbería">
                <div class="col-2">
                  <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </div>
            </form>
          </div>
      </div>
  </header>

</div>
@endsection
