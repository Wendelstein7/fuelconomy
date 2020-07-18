<?php

/** @var Factory $factory */

use App\Refuel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Refuel::class, function (Faker $faker)
{
    $distance = (float) $faker->randomFloat(1, 100, 1000);
    return [
        'trip_distance' => $distance,
        'fuel_amount' => $distance / $faker->randomFloat(3, 10, 20),
        'fuel_unit_price' => $faker->randomFloat(3, 1.25, 1.75),
        'date' => $faker->dateTimeBetween('+1 week', '+1 year'),
    ];
});
