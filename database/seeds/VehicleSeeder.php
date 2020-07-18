<?php

use App\User;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user)
        {
            factory(App\Vehicle::class, 3)->create(['user_id' => $user->id]);
        });
    }
}
