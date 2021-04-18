<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = [
      'name',
  ];

    public function User(){
      return $this->hasOne(User::class);
    }
}
