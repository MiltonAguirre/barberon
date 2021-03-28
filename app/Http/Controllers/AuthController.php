<?php

namespace App\Http\Controllers;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// REVIEW!! ! ! !! ! https://codebrains.io/es/how-to-add-jwt-authentication-to-laravel-api/
use Hash;

class AuthController extends Controller
{
    public function signupClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|min:3|max:255|unique:users|alpha_dash',
            'email' => 'required|string|email|min:6|max:255|unique:data_users',
            'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'state' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
        ],
        [
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
            'city.required' => 'Debe ingresar la ciudad destino.',
            'city.string' => 'La ciudad destino es inválida.',
            'city.min' => 'La ciudad no puede ser tan corta.',
            'city.max' => 'La ciudad no puede ser tan larga.',
            'city.regex' => 'La ciudad debe contener solo letras y espacios.',
            'state.required' => 'Debe ingresar la localidad destino.',
            'state.string' => 'La localidad destino es inválida.',
            'state.min' => 'La localidad no puede ser tan corta.',
            'state.max' => 'La localidad no puede ser tan larga.',
            'state.regex' => 'La localidad debe contener solo letras y espacios.',
            'rol.required' => 'Debe seleccionar un rol.',
            'role.numeric' => 'El rol debe ser un número.',
            'role.digits_between' => 'El rol es incorrecto.'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = new User(
            $request->get('email'),
            $request->get('city'),
            $request->get('state'),
            $request->get('username'),
            $request->get('password'),
            2,
            "",
            null
        );
        $tokenResult = $user->createToken('Personal Access Token');
          $user->last_conection = now();
          $user->save();
          $token = $tokenResult->token;
          if ($request->remember_me) {
              $token->expires_at = Carbon::now()->addWeeks(1);
          }
          $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken], 201);
    }
    public function signupProfessional(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            // 'first_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            // 'last_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'username' => 'required|string|min:3|max:255|unique:users|alpha_dash',
            'email' => 'required|string|email|min:6|max:255|unique:data_users',
            // 'phone' => 'required|numeric|digits_between:5,20',
            // 'addressname' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            // 'addressnum' => 'required|numeric|digits_between:1,10',
            // 'addressfloor' => '',
            // 'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            // 'location' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            // 'zip' => 'required|numeric|digits_between:3,10',
            // 'role' => 'required|numeric|digits_between:1,1',
            'categories' => 'required',
            'image_back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
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
            'rol.required' => 'Debe seleccionar un rol.',
            'role.numeric' => 'El rol debe ser un número.',
            'role.digits_between' => 'El rol es incorrecto.'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }
        $image_front = $request->file('image_front');
        \Log::debug(($request));
        $user = new User(
            "SD",
            "SD",
            $request->get('email'),
            $request->get('phone'),
            "",
            "",
            "",
            "",
            "",
            $request->get('username'),
            $request->get('password'),
            3,
            "",
            $request->get('categories'),
            $request->file('image_front'),
            $request->file('image_back')
        );
        $tokenResult = $user->createToken('Personal Access Token');
        $user->last_conection = now();
        $user->save();
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken], 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username'       => 'required|string',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
          ]);
          if ($validator->fails()){
              return response()->json(['errors' => $validator->errors()]);
          }

          // $credentials = request(['email', 'password']);
          // if (!\Auth::guard('api')->check($credentials)) {
          //     return response()->json([
          //         'message' => 'Unauthorized'], 401);
          // }
          $user = User::where('username',$request->username)->first();
          if (!$user){

              return response()->json([
                  'message' => 'Unauthorized'], 401);
          }
          //BUG ! ! ! !
          // BUST BE Hash::check("password",bcrypt("password"))

          if (!Hash::check($request->password,$user->password)){
              return response()->json([
                  'message' => 'Unauthorized'], 401);
          }
          $tokenResult = $user->createToken('Personal Access Token');
          $user->last_conection = now();
          $user->save();
          $token = $tokenResult->token;
          if ($request->remember_me) {
              $token->expires_at = Carbon::now()->addWeeks(1);
          }
          $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'role'   => $user->role->id,
            'user_id'   => $user->id,
            'username'   => $user->username,
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
