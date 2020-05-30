@extends('layouts.app')
@section('content')
<div class="container">
  @if($message)
    <div class="alert alert-success">
      {{$message}}
    </div>
  @endif
  <div class="edithead">
    <div>Resultados de la busqueda</div>
  </div>
  @if(count($barbers))
    @foreach ($barbers as $barber)
      <div class="card">
        <p>Nombre de barberia: {{$barber->name}}</p>
        <p>Telefono: {{$barber->phone}}</p>
      </div>
      <hr>
    @endforeach
  @endif
</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
@endsection
