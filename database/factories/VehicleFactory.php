<?php

/** @var Factory $factory */

use App\Fuel;
use App\Vehicle;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Vehicle::class, function (Faker $faker)
{
    return [
        'name' => $faker->randomElement(['Red ', 'Green ', 'Blue ', 'Silver ', 'Black ', 'White ']).$faker->randomElement(['Volkswagen', 'Citroën', 'Volvo', 'Audi', 'Mercedes', 'BMW', 'Suzuki', 'Hyundai']),
        'fuel_type' => $faker->randomElement(Fuel::TYPES),
        'initial_odo' => $faker->numberBetween(0, 300000),
        'notes' => $faker->boolean ? $faker->sentence : null,
    ];
});
