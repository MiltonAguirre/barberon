<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker){
    return [
        'username' => $faker->username,
        'password' => '$2y$10$hvDP.uUN65LIxe3uLxz.te0r/gsbFqOgabOKvKfSgiNYU4RWmW.wq', // asdasd
        'role_id' => function(){
          return rand(1,3);
        },
        'location_id' => function(){
          return factory(App\Location::class)->create()->id;
        },
        'data_user_id' => function(){
          return factory(App\DataUser::class)->create()->id;
        },
        'remember_token' => 0,
        'last_conection' => date('Y-m-d'),
    ];
});

$factory->state(App\User::class, 'admin', [
    'username' => 'admin',
    'role_id' => 1
]);
$factory->state(App\User::class, 'client', [
    'username' => 'cliente',
    'role_id' => 2,
]);
$factory->state(App\User::class, 'barber', [
    'username' => 'barbero',
    'role_id' => 3
]);
