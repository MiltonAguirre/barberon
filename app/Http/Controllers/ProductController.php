<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Product;
use \App\Barber;
use \App\ImageProduct;
use Validator;

class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:api');
  }

  public function show($id)
  {
    $product = Product::find($id);
    if(!$product){
      return response()->json([
        'message'=>'Error, no se ha encontrado el producto'
      ],400);
    }else{
      return response()->json($product, 200);
    }

  }

  public function showAllProducts($id)
  {
    $products = Product::where('barber_id', $id)->get();
    if(count($products)){
      foreach($products as $product){
        $product['images'] = $product->images;
      }
      return response()->json($products,200);

    }
    else{
      return response()->json([],200);
    }
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'description' => 'required|string|min:10|max:255|regex:/^[\pL\s]+$/u',
      'price' => 'required|numeric',
      'hours' => 'required|integer|min:0|max:24',
      'minutes' => 'required|integer|min:0|max:30',
      'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($validator->fails()){
      return response()->json(['errors' => $validator->errors()]);
    }

    $user = auth('api')->user();
    if(!$user || !$user->isBarber() || !$user->barber) abort(401);
    $product = new Product;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->hours = $request->hours;
    $product->minutes = $request->minutes;

    $product->barber()->associate($user->barber);
    $product->save();
    //Upload image
    $image_path = $request->file("image");

    if ($image_path) {
      $image_path_name = "products/".time().$image_path->getClientOriginalName();
      Storage::disk('public')->put($image_path_name, file_get_contents($image_path));
      $image= new ImageProduct();
      $image->path = $image_path_name;
      $image->product()->associate($product);
      $image->save();
    }

    $products = $user->barber->products;
    foreach($products as $product){
      $product['images'] = $product->images;
    }

    return response()->json([
      'products'=>$products,
      'message'=>'Se agregó un nuevo producto a su barbería'
    ],200);
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'description' => 'required|string|min:10|max:255|regex:/^[\pL\s]+$/u',
      'price' => 'required|numeric',
      'hours' => 'required|integer|min:0|max:24',
      'minutes' => 'required|integer|min:0|max:30',
      'id' => 'required|integer|min:1'
    ]);
    if ($validator->fails()){
      return response()->json(['errors' => $validator->errors()],401);
    }

    $user = auth('api')->user();
    if(!$user || !$user->isBarber()) abort(401);

    $product = $user->barber->products()->find($request->id);
    if(!$product){
      abort(401);
    }else{
      $product->name = $request->name;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->hours = $request->hours;
      $product->minutes = $request->minutes;
      $product->save();

    }
    //Upload image
    /*
    $image_path = $request->file('image');
    if ($image_path) {
      //delete image for be replace
      if($product->image){
        Storage::disk('products')->delete($product->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('products')->put($image_path_name, File::get($image_path));
      $product->image = $image_path_name;
    }
    */
    $products = $user->barber->products;
    foreach($products as $product){
      $product['images'] = $product->images;
    }
    return response()->json([
      'products' => $products,
      'message'=>'Su producto fue editado correctamente'
    ],200);
  }

  public function destroy($id)
  {
    $user = auth('api')->user();
    if(!$user || !$user->isBarber() || !$user->barber) abort(401);
    $product = $user->barber->products()->find($id);

    if(!$product) abort(401);

    $product->delete();

    return response()->json([
      'message'=>'El producto fue eliminado de su barbería'
    ],200);
  }


}
