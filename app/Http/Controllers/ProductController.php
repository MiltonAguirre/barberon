<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
