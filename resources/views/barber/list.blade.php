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
  <div class="table-responsive">
    <table class="table table-light">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Phone</th>
          <th scope="col">Dirección</th>
          <th scope="col">Ciudad</th>
          <th scope="col">Localidad</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1 ?>
        @foreach($barbers as $barber)
        <tr>
          <th scope="row">{{$i++}}</th>
          <td><a href="/barber/show/{{$barber->id}}">{{$barber->name}}</a></td>
          <td>{{$barber->phone}}</td>
          <td>{{$barber->location->addressname." ".$barber->location->addressnum}}</td>
          <td>{{$barber->location->city}}</td>
          <td>{{$barber->location->location}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection

@section('script')
  <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
@endsection
