<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function showProducts($id)
  {
    $products = \App\Product::where('barber_id', $id)->get();
    if(count($products)){
      return view('product.show', ['products' => $products]);
    }else{
      return redirect("/barber/show/".$id)->with('message', 'Error, no se encontraron productos');
    }
  }

  public function addProduct()
  {
    return view('product.create', ['user' => \Auth::user()]);
  }

  public function getImage($filename)
  {
    $file = Storage::disk('products')->get($filename);
    return new Response($file,200);
  }

  public function newProduct(Request $request)
  {
    $request->validate([
      'name' => 'required|string|min:3|max:255|regex:/^[\pL\s]+$/u',
      'price' => 'required|numeric|digits_between:5,20',
      'delay' => 'required|numeric|digits_between:5,20',
      'image_path' => 'required|image'
    ],
    [
      'image_path.image' => 'La imagen no es un archivo válido.',
      'image_path.required' => 'Debe subir una foto del trabajo.',
      'name.required' => 'Debe ingresar un nombre descriptivo.',
      'name.min' => 'El nombre no puede ser tan corto.',
      'name.max' => 'El nombre no puede ser tan largo.',
      'name.regex' => 'El nombre debe contener solo letras y espacios.',
      'name.string' => 'El nombre es inválido.',
      'delay.required' => 'Debe ingresar un tiempo estimado de trabajo.',
      'delay.numeric' => 'El tiempo estimado debe contener solo números.',
      'delay.digits_between' => 'El tiempo ingresado es inválido.',
      'price.required' => 'Debe ingresar el precio del trabajo.',
      'price.numeric' => 'El precio debe contener solo números.',
      'price.digits_between' => 'El precio no es válido.',

    ]);
    $user = \Auth::user();
    $product = new \App\Product;
    $product->name = $request->get('name');
    $product->price = $request->get('price');
    $product->delay = $request->get('delay');
    //Upload image
    $image_path = $request->file('image_path');
    if ($image_path) {
      //delete image for be replace
      if($product->image){
        Storage::disk('products')->delete($product->image);
      }
      $image_path_name = time().$image_path->getClientOriginalName();
      Storage::disk('products')->put($image_path_name, File::get($image_path));
      $product->image = $image_path_name;
    }
    $product->barber()->associate($user->barber->id);
    $product->save();

    return redirect("/barber/products/".$user->barber->id)->with('message', 'El producto se guardo con exito');
  }


}
