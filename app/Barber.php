<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
  protected $fillable = [
      'name', 'phone', 'image_path',
  ];
  public function location(){
    return $this->belongsto(Location::class);
  }
  public function products(){
    return $this->hasMany(Product::class);
  }
  public function user(){
    return $this->belongsto(User::class);
  }
  public function getName(){
    return $this->name;
  }
}
