<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name', 'description', 'price', 'delay',
  ];
  public function barber(){
    return $this->belongsTo(Barber::class);
  }
  public function image(){
    return $this->hasOne(Image::class);
  }
  public function getPrice(){
    return $this->price;
  }
  public function getDelay(){
    return $this->delay;
  }
  public function getName(){
    return $this->name;
  }
  public function getDescription(){
    return $this->description;
  }
}
