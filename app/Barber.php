<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
  protected $fillable = [
      'name','phone'
  ];

  public function user(){
    return $this->belongsto(User::class);
  }
  public function location(){
    return $this->belongsto(Location::class);
  }
  public function products(){
    return $this->hasMany(Product::class);
  }
  public function schedule(){
    return $this->hasOne(Schedule::class);
  }
  
  function getData(){
      return [
          'id' =>  $this->id,
          'name' =>  $this->name,
          'phone' =>  $this->phone,
          'city' =>  $this->location->city,
          'address' =>  $this->location->address,
          'state' =>  $this->location->state,
      ];
  }
}
