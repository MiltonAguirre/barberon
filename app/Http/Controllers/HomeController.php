<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function search(Request $request)
    {
      $name = $request->name;
      if($name){
        $barbers = \App\Barber::where('name', 'LIKE', "%$name%")->get();
        if(count($barbers)){
          $message = "Se encontraron coincidencias";
        }else{
          $message = "No se encontraron coincidencias, estas son las barberias totales";
          $barbers = \App\Barber::all();
        }
      }else{
        $message = "Estas son todas las barberias";
        $barbers = \App\Barber::all();
      }
      return view('barber.list', ['barbers'=>$barbers, 'message'=>$message]);
    }
}
