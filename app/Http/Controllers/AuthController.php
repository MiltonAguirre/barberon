<?php

namespace App\Http\Controllers;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Hash;

// REVIEW!! ! ! !! ! https://codebrains.io/es/how-to-add-jwt-authentication-to-laravel-api/

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|min:3|max:255|unique:users|alpha_dash',
            'email' => 'required|string|email|min:6|max:255|unique:data_users',
            'address' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'state' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'first_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
            'role'=>'required|numeric|min:1|max:3'

        ],
        [
            'username.required' => 'Debe ingresar el usuario.',
            'username.string' => 'El usuario es inválido.',
            'username.min' => 'El usuario es muy corto.',
            'username.max' => 'El usuario es muy largo.',
            'username.unique' => 'El usuario ya ha sido registrado.',
            'username.alpha_dash' => 'El usuario debe contener solo letras, numeros y guiones.',
            'email.required' => 'Debe ingresar su email.',
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
            'first_name.required' => 'Debe ingresar su nombre.',
            'first_name.min' => 'El nombre no puede ser tan corto.',
            'first_name.max' => 'El nombre no puede ser tan largo.',
            'first_name.regex' => 'El nombre debe contener solo letras y espacios.',
            'first_name.string' => 'El nombre es inválido.',
            'last_name.required' => 'Debe ingresar su apellido.',
            'last_name.min' => 'El apellido no puede ser tan corto.',
            'last_name.max' => 'El apellido no puede ser tan largo.',
            'last_name.regex' => 'El apellido debe contener solo letras y espacios.',
            'last_name.string' => 'El apellido es inválido.',
            'role.required' => 'Debe seleccionar un rol.',
            'role.numeric' => 'El rol debe ser un número.',
            'role.min' => 'El rol es inválido.',
            'role.max' => 'El rol es inválido.'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = \Auth::user();
        $user->location->addressname = $request->get('addressname');
        $user->location->addressnum = $request->get('addressnum');
        $user->location->zip = $request->get('zip');
        $user->location->city = $request->get('city');
        $user->location->location = $request->get('location');
        $user->dataUser->first_name = $request->get('first_name');
        $user->dataUser->last_name = $request->get('last_name');
        $user->dataUser->phone = $request->get('phone');

        $user->dataUser->save();
        $user->location->save();
        $user->save();

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
