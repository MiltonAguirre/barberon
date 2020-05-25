<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
  protected $fillable = [
      'name', 'phone',
  ];
  public function location(){
    return $this->belongsto('App\Location', 'location_id');
  }
  public function products(){
    return $this->hasMany('App\Product');
  }
  public function user(){
    return $this->belongsTo('App\User', 'user_id');
  }
  public function getName(){
    return $this->name;
  }
}
