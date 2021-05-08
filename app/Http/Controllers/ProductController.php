<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\Product;
use \App\Barber;
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
    
    return response()->json($products,200);

  }

  // public function getImage($filename)
  // {
  //   $file = Storage::disk('products')->get($filename);
  //   return new Response($file,200);
  // }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'description' => 'required|string|min:10|max:255|regex:/^[\pL\s]+$/u',
      'price' => 'required|numeric',
      'delay' => 'required|numeric|min:30',
      //'image_path' => 'required|image'
    ],
    [
      'image_path.image' => 'La imagen no es un archivo válido.',
      'image_path.required' => 'Debe subir una foto del trabajo.',
      'name.required' => 'Debe ingresar un nombre descriptivo.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es inválido.',
      'description.required' => 'Debe ingresar una descripción del producto.',
      'description.min' => 'La descripción no puede ser tan corta.',
      'description.max' => 'La descripción no puede ser tan larga.',
      'description.regex' => 'La descripción debe contener solo letras y espacios.',
      'description.string' => 'La descripción es inválida.',
      'delay.required' => 'Debe ingresar un tiempo estimado de trabajo.',
      'delay.numeric' => 'El tiempo estimado debe contener solo números.',
      'delay.min' => 'El tiempo ingresado debe ser mínimo 30 minutos.',
      'price.required' => 'Debe ingresar el precio del trabajo.',
      'price.numeric' => 'El precio debe contener solo números.'
    ]);
    $user = auth('api')->user();
    if(!$user || !$user->isBarber() || !$user->barber) abort(401);
    $product = new Product;
    $product->name = $request->get('name');
    $product->description = $request->get('description');
    $product->price = $request->get('price');
    $product->delay = $request->get('delay');
    //Upload image
    // $image_path = $request->file('image_path');
    // if ($image_path) {
    //   //delete image for be replace
    //   if($product->image){
    //     Storage::disk('products')->delete($product->image);
    //   }
    //   $image_path_name = time().$image_path->getClientOriginalName();
    //   Storage::disk('products')->put($image_path_name, File::get($image_path));
    //   $product->image = $image_path_name;
    // }
    $product->barber()->associate($user->barber->id);
    $product->save();

    return response()->json([
      'message'=>'Se agregó un nuevo producto a su barbería'
    ],200);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'description' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'price' => 'required|numeric',
      'delay' => 'required|numeric|min:30',
      //'image_path' => 'image'
    ],
    [
      'image_path.image' => 'La imagen no es un archivo válido.',
      'name.required' => 'Debe ingresar un nombre descriptivo.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es inválido.',
      'description.required' => 'Debe ingresar una descripción del producto.',
      'description.min' => 'La descripción no puede ser tan corta.',
      'description.max' => 'La descripción no puede ser tan larga.',
      'description.regex' => 'La descripción debe contener solo letras y espacios.',
      'description.string' => 'La descripción es inválida.',
      'delay.required' => 'Debe ingresar un tiempo estimado de trabajo.',
      'delay.numeric' => 'El tiempo estimado debe contener solo números.',
      'delay.min' => 'El tiempo ingresado debe ser mínimo de 30 minutos.',
      'price.required' => 'Debe ingresar el precio del trabajo.',
      'price.numeric' => 'El precio debe contener solo números.',

    ]);
    $user = auth('api')->user();
    if(!$user || !$user->isBarber()) abort(401);
    $product = $user->barber->products()->find($id);
    if(!$product){
      abort(401);
    }else{
      $product->name = $request->get('name');
      $product->description = $request->get('description');
      $product->price = $request->get('price');
      $product->delay = $request->get('delay');
      $product->save();

    }
    //Upload image
    // $image_path = $request->file('image_path');
    // if ($image_path) {
    //   //delete image for be replace
    //   if($product->image){
    //     Storage::disk('products')->delete($product->image);
    //   }
    //   $image_path_name = time().$image_path->getClientOriginalName();
    //   Storage::disk('products')->put($image_path_name, File::get($image_path));
    //   $product->image = $image_path_name;
    // }

    return response()->json([
      'message'=>'Se editó su producto correctamente'
    ],200);
  }

  public function destroy($id)
  {
    $user = auth('api')->user();
    if(!$user || !$user->isBarber()) abort(401);
    $product = $user->barber->products()->find($id);
    $user = auth('api')->user();
    if(!$product){
      abort(401);
    }
    $product->delete();
    return response()->json([
      'message'=>'Se quitó el producto de su barbería correctamente'
    ],200);
  }


}
