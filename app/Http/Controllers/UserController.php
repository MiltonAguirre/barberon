<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function config(){
    return view('user.config', ['user' => \Auth::user()]);
  }
  public function show(){
    return view('user.show', ['user' => \Auth::user()]);
  }
  public function profile_img()
  {
    return view('user.image_profile', ['user' => \Auth::user()]);
  }
  public function getImage($filename)
  {
    $file = Storage::disk('users')->get($filename);
    return new Response($file,200);
  }
  //UPDATE DATA
  public function update(Request $request){
    $request->validate([
      'first_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'last_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'phone' => 'required|numeric|digits_between:5,20',
      'addressname' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'addressnum' => 'required|numeric|digits_between:1,10',
      'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'location' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'zip' => 'required|numeric|digits_between:3,10',
      'image_path' => 'image'
    ],
    [
      'image_path.image' => 'La imagen no es un archivo válido.',
      'first_name.required' => 'Debe ingresar el nombre del destinatario.',
      'first_name.min' => 'El nombre no puede ser tan corto.',
      'first_name.max' => 'El nombre no puede ser tan largo.',
      'first_name.regex' => 'El nombre debe contener solo letras y espacios.',
      'first_name.string' => 'El nombre es incorrecto.',
      'last_name.required' => 'Debe ingresar el apellido del destinatario.',
      'last_name.min' => 'El apellido no puede ser tan corto.',
      'last_name.max' => 'El apellido no puede ser tan largo.',
      'last_name.regex' => 'El apellido debe contener solo letras y espacios.',
      'last_name.string' => 'El apellido es incorrecto.',
      'phone.required' => 'Debe ingresar el número telefónico.',
      'phone.numeric' => 'El número telefónico debe contener solo números.',
      'phone.digits_between' => 'El número telefónico es inválido.',
      'addressname.required' => 'Debe ingresar la dirección destino.',
      'addressname.string' => 'La dirección destino es inválida.',
      'addressname.min' => 'La dirección no puede ser tan corta.',
      'addressname.max' => 'La dirección no puede ser tan larga.',
      'addressname.regex' => 'La dirección debe contener solo letras y espacios.',
      'addressnum.required' => 'La altura es requerida.',
      'addressnum.numeric' => 'La altura debe contener solo números.',
      'addressnum.digits_between' => 'La altura es inválida.',
      'city.required' => 'Debe ingresar la ciudad destino.',
      'city.string' => 'La ciudad destino es inválida.',
      'city.min' => 'La ciudad no puede ser tan corta.',
      'city.max' => 'La ciudad no puede ser tan larga.',
      'city.regex' => 'La ciudad debe contener solo letras y espacios.',
      'location.required' => 'Debe ingresar la localidad destino.',
      'location.string' => 'La localidad destino es inválida.',
      'location.min' => 'La localidad no puede ser tan corta.',
      'location.max' => 'La localidad no puede ser tan larga.',
      'location.regex' => 'La localidad debe contener solo letras y espacios.',
      'zip.required' => 'Debe ingresar el codigo postal destino.',
      'zip.numeric' => 'El codigo postal debe contener solo números.',
      'zip.digits_between' => 'El código postal es incorrecto.',

    ]
    );
    $user = \Auth::user();

    $user->location->addressname = $request->get('addressname');
    $user->location->addressnum = $request->get('addressnum');
    $user->location->zip = $request->get('zip');
    $user->location->city = $request->get('city');
    $user->location->location = $request->get('location');
    $user->dataUser->first_name = $request->get('first_name');
    $user->dataUser->last_name = $request->get('last_name');
    $user->dataUser->phone = $request->get('phone');
    //Upload image
    $image_path = $request->file('image_path');
    if ($image_path) {
      //delete image for be replace
      if($user->image){
        Storage::disk('users')->delete($user->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('users')->put($image_path_name, File::get($image_path));
      $user->image = $image_path_name;
    }
    $user->dataUser->save();
    $user->location->save();
    $user->save();
    $request->session()->flash('alert-success', 'User was successful uploaded!');
    return redirect(route('user.profile'))->with('message','Se ha actualizado el usuario correctamente');
  }
  public function save_img(Request $request)
  {
    $request->validate(
      ['image_path' => 'image'], ['image_path.image' => 'La imagen no es un archivo válido.']
    );
    $image_path = $request->file('image_path');
    $user = \Auth::user();
    if ($image_path) {
      if($user->image){
        Storage::disk('users')->delete($user->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('users')->put($image_path_name, File::get($image_path));
      $user->image = $image_path_name;
      $user->save();
    }
    return redirect(route('user.profile'))->with('message','Se ha actualizado la foto de perfíl correctamente');

  }
}
