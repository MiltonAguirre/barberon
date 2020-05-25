<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'first_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
          'last_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
          'username' => 'required|string|min:3|max:255|unique:users|alpha_dash',
          'email' => 'required|string|email|min:6|max:255|unique:data_users',
          'phone' => 'required|numeric|digits_between:5,20',
          'addressname' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
          'addressnum' => 'required|numeric|digits_between:1,10',
          'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
          'location' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
          'zip' => 'required|numeric|digits_between:3,10',

        ],[
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
          'username.required' => 'Debe ingresar el usuario.',
          'username.string' => 'El usuario es incorrecto.',
          'username.min' => 'El usuario es muy corto.',
          'username.max' => 'El usuario es muy largo.',
          'username.unique' => 'El usuario ya ha sido registrado.',
          'username.alpha_dash' => 'El usuario debe contener solo letras, numeros y guiones.',
          'email.required' => 'Debe ingresar el email del destinatario.',
          'email.email' => 'El correo electrónico no es valido.',
          'email.max' => 'El correo electrónico es muy largo.',
          'email.min' => 'El correo electrónico es muy corto.',
          'email.unique' => 'El correo ya ha sido registrado.',
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
          
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
    $data_user = \App\DataUser::create([
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'phone' => $data['phone'],
    ]);
    $location = \App\Location::create([
      'addressname' => $data['addressname'],
      'addressnum' => $data['addressnum'],
      'zip' => $data['zip'],
      'city' => $data['city'],
      'location' => $data['location'],
    ]);
      $user = new \App\User;
      $user->dataUser()->associate($data_user);
      $user->location()->associate($location) ;

      $user->username = $data['username'];
      $user->password = bcrypt('asdasd' );

      $user->save();

      return $user;
    }
}
