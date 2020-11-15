<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
      'addressname' => explode(" ",$faker->address)[1],
      'addressnum' => explode(" ",$faker->address)[0],
      'zip' => 3051,
      'city' => $faker->city,
      'location' => "Córdoba",
    ];
});
