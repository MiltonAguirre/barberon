<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $fillable = [
    'image_path',
  ];
  public function user(){
    return $this->belongsto(User::class);
  }
  public function barber(){
    return $this->belongsto(Barber::class);
  }
  public function product(){
    return $this->hasOne(Product::class);
  }
}
