<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function create($id){
    $product = \App\Product::find($id);
    return view('turn.createTurn', ['product' => $product]);
  }

  public function save(Request $request, $id){
    // $request->validate([
    //   'dateTurn' => 'required',
    //   'timeTurns' => 'required',
    // ],
    // [
    //   'dateTurn.required' => 'Debe elegír una fecha para el turno',
    //   'timeTurns.required' => 'Debe elegír una hora para el turno'
    // ]);
    $user = \Auth::user();

    $product = \App\Product::find($id);
    if(!$product){
      return redirect(route('home'))->with('message', "No se ha encontrado el producto");
    }
    $turn = new \App\Turn();
    $turn->date = $request->get('dateTurn');
    $turn->hour = $request->get('timeTurn');
    $turn->state = "Activo";
    $barber = \App\Barber::find($product->barber_id);
    $turn->product()->associate($product);
    $turn->barber()->associate($barber);
    $turn->user()->associate($user);
    $turn->save();

    return redirect(route('user.turns'))->with('message', "Se agenda su turno exitosamente");
  }

    public function destroy($id){
      \App\Turn::find($id)->delete();
      return redirect(route('user.turns'))->with('message', "Se ha cancelado el turno");
    }

}
