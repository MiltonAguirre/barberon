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
    $userAuth = auth('api')->user();
    if(!$userAuth){
      abort(401);
    }
    return response()->json($userAuth->getData());
  }

}
