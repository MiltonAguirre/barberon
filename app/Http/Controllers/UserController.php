<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Product;
use \App\Barber;
use \App\Turn;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    function show()
    {
        $user = auth('api')->user();
        if(!$user)  abort(401);

        return response()->json($user->getData());
    }

    function storeTurn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required|date_format:Y-m-d H:i|after:now',
            'product_id' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }
        $user = auth('api')->user();
        if(!$user) abort(401);

        $product = Product::findOrFail($request->product_id);
        $turn = new Turn;
        $turn->start = $request->start;
        $turn->user()->associate($user);
        $turn->product()->associate($product);
        $turn->barber()->associate($product->barber);
        $turn->save();

        return response()->json([
        'message'=>'Se ha agendado su turno con éxito'
        ],200);
    }

   function getTurns()
   {
        $user = auth('api')->user();
        if(!$user) abort(401);
        foreach($user->turns as $turn ){
            $turn["product_name"] = $turn->product->name;
            $turn["barber_name"] = $turn->barber->name;

        }
        $turns = $user->turns ? $user->turns : [];

        return response()->json($turns,200);
   }

   function cancelTurn(Request $request)
   {
        $validator = Validator::make($request->all(), [
            'turn_id' => 'required|integer|min:1',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }
        $user = auth('api')->user();
        if(!$user) abort(401);

        $turn = Turn::findOrFail($request->turn_id);
        if($user->id !== $turn->user->id) abort(401);

        $turn->state = 'canceled';
        $turn->save();

        foreach($user->turns as $turn ){
            $turn["product_name"] = $turn->product->name;
            $turn["barber_name"] = $turn->barber->name;

        }
        $turns = $user->turns ? $user->turns : [];

        return response()->json([
            'turns'=>$turns,
            'message'=>'Se ha cancelado el turno con éxito'
        ],200);
   }
}
