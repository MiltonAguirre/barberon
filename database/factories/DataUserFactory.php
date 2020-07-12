<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DataUser;
use Faker\Generator as Faker;

$factory->define(DataUser::class, function (Faker $faker) {
    return [
      'first_name' => $faker->firstname,
      'last_name' => $faker->lastname,
      'email' => $faker->unique()->safeEmail,
      'phone' => rand(1000000,10000000000),
    ];
});
