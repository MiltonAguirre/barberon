<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  public $timestamps = false;
 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
    'address','city','state',
 ];
 public function user(){
   return $this->hasOne(User::class);
 }
 public function barber(){
   return $this->hasOne(Barber::class);
 }
 public function getAddress(){
   return $this->address." ". $this->city . ", ". $this->state;
 }
}
