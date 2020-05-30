<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create()
  {
      return view('image.create');
  }
  public function getImage($filename)
  {
    $file = Storage::disk('users')->get($filename);
    return new Response($file,200);
  }
  public function save(Request $request)
  {
    $validate = $this->validate($request, [
      'image_path' => 'required|image'
    ]);
    $user = \Auth::user();
    $image = new \App\Image;
    $image->user_id = $user->id;
    //Upload image
    $image_path = $request->file('image_path');
    if ($image_path) {
      //delete image for be replace
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('images')->put($image_path_name, File::get($image_path));
      $image->image_path = $image_path_name;
    }
    $image->save();
    return redirect()->route('home')->with(['message'=>"La imagen ha sido subida con éxito"]);
  }
}
