@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container p-3 my-3 bg-dark text-white text-center card">
    <h3>Mis turnos</h3>
  </div>
  @if(!count($turns))
    <div class="container p-2 border border-dark rounded">
      <h5 class="text-center">No posee turnos para mostrar</h5>
    </div>
  @else

    <div class="table-responsive card">
      <table class="table table-light">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($turns as $turn)
          <tr>
            <th>*</th>
            <td>{{$turn->user->dataUser->first_name." ".$turn->user->dataUser->last_name}}</td>
            <td>{{$turn->user->dataUser->phone}}</td>
            <td>{{$turn->date}}</td>
            <td>{{$turn->hour}}</td>
            <td>{{$turn->state}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
