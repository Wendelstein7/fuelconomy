<?php

use App\Fuel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table)
        {
            $table->id();

            $table->foreignId('user_id')->comment('User owning the vehicle')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->comment('Name of the vehicle')->default('unnamed vehicle');
            $table->enum('fuel_type', [Fuel::DIESEL, Fuel::GASOLINE, Fuel::NATURAL_GAS, Fuel::LPG, Fuel::ETHANOL, Fuel::ELECTRICITY, Fuel::HYDROGEN])->comment('Fuel type consumed by the vehicle')->nullable();
            $table->unsignedDecimal('initial_odo', '10', '3')->comment('The initial odometer value of the vehicle')->default(0);
            $table->string('notes')->comment('Notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
