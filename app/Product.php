<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name','price','delay', 'description', 'image'
  ];
  //Relationshps
  public function barber(){
    return $this->belongsto(Barber::class);
  }
}
