@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  <header class="masthead">
      <div class="container">
        <div class="masthead-heading">Bienvenido a BarberON</div>
          <div class="masthead-subheading">Buscá tu barbería favorita y obtené tu turno</div>
          <form class="form-inline form-inline-search" method="POST" action="{{route('search')}}">
            {{ csrf_field() }}
              <input type="text" class="form-control" size="50" name="name" placeholder="Nombre de la barbería">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>
              </div>
          </form>
      </div>
  </header>

</div>
@endsection
