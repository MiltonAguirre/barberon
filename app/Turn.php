<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
  protected $fillable = [
      'state', 'hour', 'date',
  ];
  public function user()
  {
    return $this->belongsto(User::class);
  }
  public function barber()
  {
    return $this->belongsto(Barber::class);
  }
  public function product()
  {
    return $this->belongsto(Product::class);
  }
  public function getState()
  {
    return $this->state;
  }

}
