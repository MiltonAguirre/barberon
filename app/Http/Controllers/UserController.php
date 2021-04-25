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
      $this->middleware('auth:api');
  }
  function show()
  {
    $user = auth('api')->user();

    if(!$user){
      abort(401);
    }
    return response()->json($user->getData());
  }

}
