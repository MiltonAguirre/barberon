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
     'addressname','addressnum','zip','city','location',
 ];
 public function user(){
   return $this->hasOne(User::class);
 }
 public function getAddress(){
   return $this->addressname . " " . $this->addressnum . " " . $this->addressfloor . " (" . $this->zip . "), ". $this->city . " - ". $this->location;
 }
}
