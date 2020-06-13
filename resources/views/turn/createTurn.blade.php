@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-8">
    <form class="form-horizontal" action="/user/turn/save/{{$product->id}}" method="POST">
      {{ csrf_field() }}
        <div class="form-group">
          <label for="dateTurn">Selecciona la fecha deseada:</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="date" name="dateTurn" min="2020-06-01" max="2518-05-25" step="1" required>
        </div>
        <div class="form-group">
          <label for="hourTurn">Selecciona la hora deseada:</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="time" name="hourTurn" min="08:00" max="21:00" step="1800" required>
        </div>
        <div class="form-group row">
          <input type="submit" class="btn btn-success" value="Aceptar">
        </div>
    </form>
  </div>
</div>
@endsection
