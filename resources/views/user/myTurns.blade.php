@extends('layouts.app')

@section('content')
<div class="container">
  @include('includes.message')
  <div class="container p-3 my-3 bg-dark text-white" style="text-align: center">
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
            <th>
              <div class="barber-avatar">
              @if($turn->barber->image)
                <img src="{{route('barber.avatar',['filename'=>$turn->barber->image])}}"class="avatar">
              @else
                <img src="/img/empty_pic.png" alt="">
              @endif
              </div>
            </th>
            <td><a href="/barber/show/{{$turn->barber->id}}">{{$turn->barber->name}}</a></td>
            <td>{{$turn->product->name}}</td>
            <td>{{$turn->date}}</td>
            <td>{{$turn->hour}}</td>
            <td>{{$turn->state}}</td>
            <td><div class="col-md-2">
              <form action="/user/turn/delete/{{$turn->id}}" method="POST">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input class="btn btn-danger a-btn-slide-text" type="submit" value="Cancelar" />
              </form>
            </div></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
