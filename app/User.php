<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsto(Role::class);
    }
    public function dataUser(){
        return $this->belongsto(DataUser::class);
    }

    public function location(){
        return $this->belongsto(Location::class);
    }

    public function isClient(){
        return $this->role->id == 2;
    }
    public function isAdmin(){
        return $this->role->id == 1;
    }
    public function isBarber(){
        return $this->role->id == 3;
    }
    public function getUsername(){
        return $this->username;
    }

    function getData(){
        return [
            'id' =>  $this->id,
            'username' =>  $this->username,
            'first_name' =>  $this->dataUser->first_name,
            'last_name' =>  $this->dataUser->last_name,
            'email' =>  $this->dataUser->email,
            'phone' =>  $this->dataUser->phone,
            'city' =>  $this->location->city,
            'address' =>  $this->location->address,
            'state' =>  $this->location->state,
        ];
    }


}
