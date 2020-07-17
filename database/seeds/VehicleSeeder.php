<?php

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
        DB::table('vehicles')->insertOrIgnore([
            'user_id' => 1,
            'name' => 'Silver Volkswagen Multivan',
            'fuel_type' => \App\Fuel::DIESEL,
            'initial_odo' => 290523,
            'notes' => 'Model 2005, modified to RV 🚐',
        ]);
    }
}
