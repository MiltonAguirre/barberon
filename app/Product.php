<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name','price','hours','minutes','description'
  ];
  //Relationshps
  public function barber(){
    return $this->belongsto(Barber::class);
  }
  public function images(){
    return $this->hasMany(ImageProduct::class);
  }
}
