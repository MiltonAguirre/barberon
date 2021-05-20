<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'days', 'open', 'close'
    ];
    //Relationshps
    public function barber(){
      return $this->belongsto(Barber::class);
    }
}
