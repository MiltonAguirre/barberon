<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
      'address' =>$faker->streetAddress,
      'city' => "Santo Tome",
      'state' => "Santa Fe",
    ];
});
