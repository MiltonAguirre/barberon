<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $fillable = [
        'start', 'state', 'product_id'
    ];
    //Relationshps
    public function user(){
      return $this->belongsto(User::class);
    }
    public function product(){
      return $this->belongsto(Product::class);
    }
    public function barber(){
        return $this->belongsto(Barber::class);
    }
}
