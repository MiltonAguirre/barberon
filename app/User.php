<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'username', 'password', 'role',
     ];

     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
         'password', 'remember_token',
     ];

     public function dataUser(){
       return $this->belongsto(DataUser::class);
     }

     public function location(){
       return $this->belongsto(Location::class);
     }
     public function image(){
       return $this->hasMany(Image::class);
     }
     public function turn(){
       return $this->hasMany(Turn::class);
     }
     public function barber(){
       return $this->hasOne(Barber::class);
     }

     public function getUsername(){
       return $this->username;
     }
     public function getRole(){
       if($this->role==2){
         return "Barbero";
       }else{
         return "Cliente";
       }
     }
     public function isBarber(){
       if($this->role==2){
         return true;
       }else{
         return false;
       }
     }

}
