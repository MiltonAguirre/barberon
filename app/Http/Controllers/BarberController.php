<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use \App\Barber;
use \App\Location;
use \App\Schedule;


class BarberController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api');
  }

  public function showMyBarber()
  {
    /*if(is_numeric($id)){
      $barber = Barber::find($id);
      if(!$barber){
        return response()->json([
          'message'=>'Error, no hemos encontrado la barbería'
        ],400);
      }else{
        return response()->json($barber->getData(),200);
      }

    }else{*/
      $user = auth('api')->user();
      if(!$user || !$user->isBarber())
      return response()->json([
        'message'=>'Usted no tiene los permisos para esta acción'
      ],400);

      $barber = $user->barber ? $user->barber->getData() : [];
      return response()->json($barber,200);

    //}
  }

  public function showBarbers(Request $request)
  {
    $user = auth('api')->user();
    $city = $user->location->city;
    $state = $user->location->state;

    $barbers = Barber::join('locations', 'barbers.location_id', '=', 'locations.id')
                      ->where('locations.city',$city)
                      ->where('locations.state', $state)
                      ->select('barbers.id', 'barbers.name', 'barbers.phone', 'locations.address', 'locations.city', 'locations.state')
                      ->get();
    $response = [];
    foreach($barbers as $barber){
      $res = [];
      $res['data'] = $barber->getData();
      //$res['schedules'] = $barber->getSchedules();
      $response[] = $res;
    }

    return response()->json($response,200);

  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'phone' => 'required|min:5|max:20',
      'address' => 'required|string|min:3|max:255',
      'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'state' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      // 'image_path' => 'image'
    ],
    [
      'name.required' => 'Debe ingresar el nombre de la barbería.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es incorrecto.',
      'phone.required' => 'Debe ingresar el número telefónico de la barbería.',
      'phone.min' => 'El número telefónico es demasiado corto.',
      'phone.max' => 'El número telefónico es demasiado largo.',
      'address.required' => 'Debe ingresar la dirección donde atiende.',
      'address.string' => 'La dirección es inválida.',
      'address.min' => 'La dirección no puede ser tan corta.',
      'address.max' => 'La dirección no puede ser tan larga.',
      'city.required' => 'Debe ingresar la ciudad donde atiende.',
      'city.string' => 'La ciudad es inválida.',
      'city.min' => 'La ciudad no puede ser tan corta.',
      'city.max' => 'La ciudad no puede ser tan larga.',
      'city.regex' => 'La ciudad debe contener solo letras y espacios.',
      'state.required' => 'Debe ingresar la localidad donde atiende.',
      'state.string' => 'La localidad es inválida.',
      'state.min' => 'La localidad no puede ser tan corta.',
      'state.max' => 'La localidad no puede ser tan larga.',
      'state.regex' => 'La localidad debe contener solo letras y espacios.',
      'image_path.image' => 'La imagen no es un archivo válido.',

    ]);
    if($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }
    $user = auth('api')->user();
    if(!$user || !$user->isBarber() || $user->barber) abort(401);

    $location = Location::create([
      'address' => $request->address,
      'city' => $request->city,
      'state' => $request->state,
    ]);
    $barber = new Barber;
    $barber->name = $request->name;
    $barber->phone = $request->phone;
    //Upload image
    // $image_path = $request->file('image_path');
    // if ($image_path) {
    //   //delete image for be replace
    //   if($barber->image){
    //     Storage::disk('barbers')->delete($barber->image);
    //   }
    //   $image_path_name = time().$image_path->getClientOriginalName();
    //   Storage::disk('barbers')->put($image_path_name, File::get($image_path));
    //   $barber->image = $image_path_name;
    // }

    $barber->location()->associate($location);
    $barber->user()->associate($user);
    $barber->save();

    return response()->json([
      'barber'=>$barber->getData(),
      'message'=>'Se ha creado su barbería correctamente'
    ],200);

  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'phone' => 'required|min:5|max:20',
      'address' => 'required|string|min:3|max:255',
      'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'state' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      // 'image_path' => 'image'
    ],
    [
      'name.required' => 'Debe ingresar el nombre de la barbería.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es incorrecto.',
      'phone.required' => 'Debe ingresar el número telefónico de la barbería.',
      'phone.min' => 'El número telefónico es demasiado corto.',
      'phone.max' => 'El número telefónico es demasiado largo.',
      'address.required' => 'Debe ingresar la dirección donde atiende.',
      'address.string' => 'La dirección es inválida.',
      'address.min' => 'La dirección no puede ser tan corta.',
      'address.max' => 'La dirección no puede ser tan larga.',
      'city.required' => 'Debe ingresar la ciudad donde atiende.',
      'city.string' => 'La ciudad es inválida.',
      'city.min' => 'La ciudad no puede ser tan corta.',
      'city.max' => 'La ciudad no puede ser tan larga.',
      'city.regex' => 'La ciudad debe contener solo letras y espacios.',
      'state.required' => 'Debe ingresar la localidad donde atiende.',
      'state.string' => 'La localidad es inválida.',
      'state.min' => 'La localidad no puede ser tan corta.',
      'state.max' => 'La localidad no puede ser tan larga.',
      'state.regex' => 'La localidad debe contener solo letras y espacios.',
      'image_path.image' => 'La imagen no es un archivo válido.',

    ]);
    if($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }
    $user = auth('api')->user();
    if(!$user || !$user->isBarber()) abort(401);

    $user->barber->location->address =$request->address;
    $user->barber->location->city = $request->city;
    $user->barber->location->state = $request->state;
    $user->barber->name = $request->name;
    $user->barber->phone = $request->phone;

    //Upload image
    // $image_path = $request->file('image_path');
    // if ($image_path) {
    //   //delete image for be replace
    //   if($user->barber->image){
    //     Storage::disk('barbers')->delete($user->barber->image);
    //   }
    //   $image_path_name = time().$image_path->getClientOriginalName();
    //   Storage::disk('barbers')->put($image_path_name, File::get($image_path));
    //   $user->barber->image = $image_path_name;
    // }
    $user->barber->location->save();
    $user->barber->save();

    return response()->json(['message'=>'Se ha actualizado su barbería correctamente'],200);

  }

  public function loadSchedule(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'days' => 'required|array',
      'open' => 'required|array',
      'close' => 'required|array',
    ]);
    if($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }
    $user = auth('api')->user();
    if( !$user || !$user->isBarber() || !$user->barber ) abort(401);
    $days = json_encode($request->days);
    $open = json_encode($request->open);
    $close = json_encode($request->close);

    $schedule = new Schedule();
    $schedule->days = $days;
    $schedule->open = $open;
    $schedule->close = $close;
    $schedule->barber()->associate($user->barber);
    $schedule->save();

    return response()->json($schedule,200);

  }

  public function uploadSchedule(Request $request)
  {
    dd($request);

    $validator = Validator::make($request->all(), [
      'days' => 'required|array',
      'open' => 'required|array',
      'close' => 'required|array',
    ]);
    if($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }
    $user = auth('api')->user();
    if( !$user || !$user->isBarber() || !$user->barber ) abort(401);
    $days = json_encode($request->days);
    $open = json_encode($request->open);
    $close = json_encode($request->close);

    $schedule = $user->barber->schedule;
    $schedule->days = $days;
    $schedule->open = $open;
    $schedule->close = $close;

    $schedule->save();

    return response()->json($schedule,200);

  }

  public function getSchedules()
  {
    $validator = Validator::make($request->all(), [
      'barber_id' => 'required|numeric',
    ]);
    if($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }
    $barber = Barber::find($request->barber_id);
    $schedules = $barber->schedule ? $barber->schedule : [];
    return response()->json($schedules, 200);

  }

  public function getImage($filename)
  {
    $file = Storage::disk('barbers')->get($filename);
    return new Response($file,200);
  }

}
