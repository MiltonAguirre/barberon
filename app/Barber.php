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
  public function turns(){
    return $this->hasMany(Turn::class);
  }
  /*
  public function schedule(){
    return $this->hasOne(Schedule::class);
  }
  */
  function getData(){
      return [
          'id' =>  $this->id,
          'name' =>  $this->name,
          'phone' =>  $this->phone,
          'city' =>  $this->location ? $this->location->city : $this->city,
          'address' =>  $this->location ? $this->location->address : $this->address,
          'state' =>  $this->location ? $this->location->state : $this->state,
      ];
  }
/*
************IN CONSTRUCCION ***************
  function getSchedules(){
    if(!$this->schedule){
      return [];
    }else{

      $days = json_decode($this->schedule->days);
      $open = json_decode($this->schedule->open);
      $close = json_decode($this->schedule->close);
      return [
        'days' => $days,
        'open' => $open,
        'close' => $close
      ];
    }

  }
  */
}
