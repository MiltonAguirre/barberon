<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'name', 'price', 'delay',
  ];
  public function user(){
    return $this->belongsTo(User::class);
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
}
