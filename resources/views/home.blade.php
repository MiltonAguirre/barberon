@extends('layouts.app')

@section('content')
<div class="container">
  <header class="masthead">
      <div class="container">
        <div class="masthead-heading">Bienvenido a BarberON</div>
          <div class="masthead-subheading">Busca tu barbería favorita y obtene tu turno</div>
          <form class="form-inline form-inline-search">
              <input type="text" class="form-control" size="50" name="barber_name" placeholder="Nombre de la barberia">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>
              </div>
          </form>
      </div>
  </header>
  <div class="subheading">¿Eres Barbero? Pues pon tu barbería online <a href="{{route('barber.create')}}">aquí</a> </div>

</div>
@endsection
