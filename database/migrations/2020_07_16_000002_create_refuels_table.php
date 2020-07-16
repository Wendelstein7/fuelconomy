<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refuels', function (Blueprint $table)
        {
            $table->id();

            $table->foreignId('vehicle_id')->comment('Vehicle that was refueled')->constrained('vehicles')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedDecimal('trip_distance', '10', '3')->comment('Distance traveled since last refuel');
            $table->unsignedDecimal('fuel_amount', '6', '3')->comment('Amount of fuel units refueled');
            $table->unsignedDecimal('fuel_unit_price', '6', '3')->comment('Fuel price per unit')->nullable();
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
        Schema::dropIfExists('refuels');
    }
}
