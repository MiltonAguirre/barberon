<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
      'address' =>$faker->address,
      'city' => $faker->city,
      'state' => "Santa Fe",
    ];
});
