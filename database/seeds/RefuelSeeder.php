<?php

use App\Vehicle;
use Illuminate\Database\Seeder;

class RefuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::all()->each(function ($vehicle)
        {
            factory(App\Refuel::class, random_int(0, 15))->create(['vehicle_id' => $vehicle->id]);
        });
    }
}
