<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
  protected $fillable = [
      'name', 'open', 'close', 'open_b', 'close_b'
  ];
  public function barber()
  {
    return $this->belongsto(Barber::class);
  }
}
