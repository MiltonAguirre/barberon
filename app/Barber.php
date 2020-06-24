<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
  protected $fillable = [
      'name', 'phone',
  ];

  public function location(){
    return $this->belongsto(Location::class);
  }
  public function user(){
    return $this->belongsto(User::class);
  }
  public function image(){
    return $this->hasMany(Image::class);
  }
  public function product(){
    return $this->hasMany(Image::class);
  }
  public function turn(){
    return $this->hasMany(Turn::class);
  }
  public function schedule(){
    return $this->hasOne(Schedule::class);
  }
}
