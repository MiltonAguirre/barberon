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
  public function images(){
    return $this->hasMany(ImageProduct::class);
  }
  public function turns(){
    return $this->hasMany(Turn::class);
  }
}
