@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container p-3 my-3 bg-dark text-white">
    <h3>Mis turnos</h3>
  </div>
  <div class="table-responsive">
    <table class="table table-light">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Barbería</th>
          <th scope="col">Producto</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora</th>
          <th scope="col">Estado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($user->turn as $turn)
          <tr>
            <th>*</th>
            <td><a href="/barber/show/{{$turn->barber->id}}">{{$turn->barber->name}}</a></td>
            <td>{{$turn->product->name}}</td>
            <td>{{$turn->date}}</td>
            <td>{{$turn->hour}}</td>
            <td>{{$turn->state}}</td>
            <td>aca van acciones</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
