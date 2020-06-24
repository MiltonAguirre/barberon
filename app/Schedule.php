<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $fillable = [
      'init', 'end',
  ];
  public function barber()
  {
    return $this->belongsto(Barber::class);
  }
}
