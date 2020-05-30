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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
      dd($request);
      $barber_name = $request->barber_name;
      if(!$barber_name){
        $barbers = \App\Barber::all();
      }else{
        $barbers = \App\Barber::where('name', $barber_name)->get();
      }
      return view('barber.list', ['barbers' => $barbers]);

    }
}
