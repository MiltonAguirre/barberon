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
      //[TTI] if $search is empty return error
      $search = $request->search;
      if($search){
        $barbers = \App\Barber::where('name', 'LIKE', "%$search%")->get();
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
