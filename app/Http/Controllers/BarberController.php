<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BarberController extends Controller
{
  public function showBarber($id)
  {
    $barber =\App\Barber::find($id);
    if(!$barber){
      return redirect(route('home'))->with('message', 'Error, no se encontro la barbería');
    }else{
      return view('barber.show', ['barber' => $barber]);
    }
  }
  public function showTurns()
  {
    $barber =\Auth::user()->barber;
    if($barber){
      $turns =\App\Turn::where('barber_id',$barber->id)->get();
      return view('barber.turns', ['turns' => $turns]);
    }

  }
  public function getImage($filename)
  {
    $file = Storage::disk('barbers')->get($filename);
    return new Response($file,200);
  }
  //***
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'phone' => 'required|numeric|digits_between:5,20',
      'addressname' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'addressnum' => 'required|numeric|digits_between:1,10',
      'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'location' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'zip' => 'required|numeric|digits_between:3,10',

      // 'monday' => 'required|string|min:3|max:10|alpha',
      // 'open' => 'required',
      // 'close' => 'required|after:open',
      // 'open_b' => '',
      // 'close_b' => '',

      'image_path' => 'image'
    ],
    [
      'name.required' => 'Debe ingresar el nombre de la barbería.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es incorrecto.',
      'phone.required' => 'Debe ingresar el número telefónico.',
      'phone.numeric' => 'El número telefónico debe contener solo números.',
      'phone.digits_between' => 'El número telefónico es inválido.',
      'addressname.required' => 'Debe ingresar dirección de su barbería.',
      'addressname.string' => 'La dirección es inválida.',
      'addressname.min' => 'La dirección no puede ser tan corta.',
      'addressname.max' => 'La dirección no puede ser tan larga.',
      'addressname.regex' => 'La dirección debe contener solo letras y espacios.',
      'addressnum.required' => 'Debe ingresar la altura.',
      'addressnum.numeric' => 'La altura debe contener solo números.',
      'addressnum.digits_between' => 'La altura es inválida.',
      'city.required' => 'Debe ingresar la ciudad.',
      'city.string' => 'La ciudad es inválida.',
      'city.min' => 'La ciudad no puede ser tan corta.',
      'city.max' => 'La ciudad no puede ser tan larga.',
      'city.regex' => 'La ciudad debe contener solo letras y espacios.',
      'location.required' => 'Debe ingresar la localidad.',
      'location.string' => 'La localidad es inválida.',
      'location.min' => 'La localidad no puede ser tan corta.',
      'location.max' => 'La localidad no puede ser tan larga.',
      'location.regex' => 'La localidad debe contener solo letras y espacios.',
      'zip.required' => 'Debe ingresar el codigo postal.',
      'zip.numeric' => 'El codigo postal debe contener solo números.',
      'zip.digits_between' => 'El código postal es incorrecto.',
      'image_path.image' => 'La imagen no es un archivo válido.',
      'monday.required' => 'Debe ingresar un día laboral.',
      'monday.min' => 'El nombre del día no puede ser tan corto.',
      'monday.max' => 'El nombre del día no puede ser tan largo.',
      'monday.regex' => 'El nombre del día debe contener solo letras.',
      'monday.string' => 'El nombre del día es inválido.',
      'open.required' => 'Debe ingresar un horario de apertura.',
      'close.required' => 'Debe ingresar un horario de apertura.',
      'close.after' => 'El horario de cierre debe ser después de la apertura.',
      'open_b.after' => 'El horario de apertura opcional debe ser después del cierre.',
      'close_b.after' => 'El horario de cierre opcional debe ser después de la apertura opcional.'

    ]);
    $user = \Auth::user();
    $location = \App\Location::create([
      'addressname' => $request->get('addressname'),
      'addressnum' => $request->get('addressnum'),
      'zip' => $request->get('zip'),
      'city' => $request->get('city'),
      'location' => $request->get('location'),
    ]);
    $barber = new \App\Barber;
    $barber->name = $request->get('name');
    $barber->phone = $request->get('phone');

    //Upload image
    $image_path = $request->file('image_path');
    if ($image_path) {
      //delete image for be replace
      if($barber->image){
        Storage::disk('barbers')->delete($barber->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('barbers')->put($image_path_name, File::get($image_path));
      $barber->image = $image_path_name;
    }

    $barber->location()->associate($location);
    $barber->user()->associate($user);
    $barber->save();
    // $day = new \App\Day();
    // $day->name = $request->input('monday');
    // $day->open = $request->input('open');
    // $day->close = $request->input('close');
    // $day->open_b = $request->input('open_b');
    // $day->close_b = $request->input('close_b');
    // $day->barber()->associate($barber);
    // $day->save();
    $request->session()->flash('alert-success', 'Barber was successful uploaded!');
    return view('barber.show', ['barber' => $barber])->with('message','Se ha creado su barbería correctamente');

  }

  public function update(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'phone' => 'required|numeric|digits_between:5,20',
      'addressname' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'addressnum' => 'required|numeric|digits_between:1,10',
      'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'location' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'zip' => 'required|numeric|digits_between:3,10',
      'image_path' => 'image',
      // 'monday' => 'required|string|min:3|max:10|alpha',
      // 'open' => 'required',
      // 'close' => 'required|after:open',
      // 'open_b' => '',
      // 'close_b' => '',
    ],
    [
      'image_path.image' => 'La imagen no es un archivo válido.',
      'name.required' => 'Debe ingresar el nombre de la barbería.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es incorrecto.',
      'phone.required' => 'Debe ingresar el número telefónico.',
      'phone.numeric' => 'El número telefónico debe contener solo números.',
      'phone.digits_between' => 'El número telefónico es inválido.',
      'addressname.required' => 'Debe ingresar dirección de su barbería.',
      'addressname.string' => 'La dirección es inválida.',
      'addressname.min' => 'La dirección no puede ser tan corta.',
      'addressname.max' => 'La dirección no puede ser tan larga.',
      'addressname.regex' => 'La dirección debe contener solo letras y espacios.',
      'addressnum.required' => 'Debe ingresar la altura.',
      'addressnum.numeric' => 'La altura debe contener solo números.',
      'addressnum.digits_between' => 'La altura es inválida.',
      'city.required' => 'Debe ingresar la ciudad.',
      'city.string' => 'La ciudad es inválida.',
      'city.min' => 'La ciudad no puede ser tan corta.',
      'city.max' => 'La ciudad no puede ser tan larga.',
      'city.regex' => 'La ciudad debe contener solo letras y espacios.',
      'location.required' => 'Debe ingresar la localidad.',
      'location.string' => 'La localidad es inválida.',
      'location.min' => 'La localidad no puede ser tan corta.',
      'location.max' => 'La localidad no puede ser tan larga.',
      'location.regex' => 'La localidad debe contener solo letras y espacios.',
      'zip.required' => 'Debe ingresar el codigo postal.',
      'zip.numeric' => 'El codigo postal debe contener solo números.',
      'zip.digits_between' => 'El código postal es incorrecto.',
      'monday.required' => 'Debe ingresar un día laboral.',
      'monday.min' => 'El nombre del día no puede ser tan corto.',
      'monday.max' => 'El nombre del día no puede ser tan largo.',
      'monday.regex' => 'El nombre del día debe contener solo letras.',
      'monday.string' => 'El nombre del día es inválido.',
      'open.required' => 'Debe ingresar un horario de apertura.',
      'close.required' => 'Debe ingresar un horario de apertura.',
      'close.after' => 'El horario de cierre debe ser después de la apertura.',
      'open_b.after' => 'El horario de apertura opcional debe ser después del cierre.',
      'close_b.after' => 'El horario de cierre opcional debe ser después de la apertura opcional.'

    ]);
    $user = \Auth::user();
    $user->barber->location->addressname =$request->get('addressname');
    $user->barber->location->addressnum = $request->get('addressnum');
    $user->barber->location->zip = $request->get('zip');
    $user->barber->location->city = $request->get('city');
    $user->barber->location->location = $request->get('location');
    $user->barber->name = $request->get('name');
    $user->barber->phone = $request->get('phone');

    //Upload image
    $image_path = $request->file('image_path');
    if ($image_path) {
      //delete image for be replace
      if($user->barber->image){
        Storage::disk('barbers')->delete($user->barber->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('barbers')->put($image_path_name, File::get($image_path));
      $user->barber->image = $image_path_name;
    }
    $user->barber->location->save();
    $user->barber->save();
    $request->session()->flash('alert-success', 'Barber was successful uploaded!');
    return view('barber.show', ['barber' => $user->barber])->with('message','Se ha actualizado su barbería correctamente');

  }
}
