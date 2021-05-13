<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $fillable = [
        'path',
    ];
    //Relationshps
    public function product(){
      return $this->belongsto(Product::class);
    }
}
