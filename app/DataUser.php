<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
  protected $fillable = [
      'first_name','last_name','email','phone',
  ];

    public function User(){
      return $this->hasOne(User::class);
    }


    function getCompleteName(){
      return $this->first_name . " " . $this->last_name;
    }
    function getPhone(){
      return $this->phone;
    }
    function getUsername(){
      return $this->user->getUsername();
    }
}
