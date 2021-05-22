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

  function getSchedules(){
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
