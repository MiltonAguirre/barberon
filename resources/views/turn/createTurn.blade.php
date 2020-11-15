@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header color-secondary text-dark">Obtener un turno</div>
      <div class="card-body">
        <form class="form-horizontal" action="/user/turn/save/{{$product->id}}" method="POST">
          {{ csrf_field() }}
            <div class="form-group row">
              <div class="col-4 offset-2">
                <label for="dateTurn">Selecciona la fecha deseada:</label>
              </div>
              <div class="col-6">
                <input type="date" name="dateTurn" min="2020-06-01" max="2518-05-25" step="1" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-4 offset-2">
                <label for="hourTurn">Selecciona la hora deseada:</label>
              </div>
              <div class="col-6">
                <input type="time" name="hourTurn" min="08:00" max="21:00" step="1800" required>
              </div>
            </div>
            <div class="form-group row mt-4">
              <div class="col-2 offset-2">
                <a class="btn btn-info btn-block" href="/barber/products/{{$product->barber->id}}">Cancelar</a>
              </div>
              <div class="col-2 offset-3">
                <input type="submit" class="btn btn-success btn-block" value="Aceptar">
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
