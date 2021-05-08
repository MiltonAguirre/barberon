<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name','price','delay', 'description'
  ];
  //Relationshps
  public function barber(){
    return $this->belongsto(Barber::class);
  }
}
