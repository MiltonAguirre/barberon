<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $fillable = [
        'initial', 'state'
    ];
    //Relationshps
    public function user(){
      return $this->belongsto(User::class);
    }
    public function product(){
      return $this->belongsto(Product::class);
    }
}
