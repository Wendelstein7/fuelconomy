<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refuel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'fuel_type', 'initial_odo', 'notes',
    ];

    /**
     * Scope a query to only include refuels that belong to a given vehicle.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $vehicle
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromVehicle($query, $vehicle)
    {
        return $query->where('vehicle_id', $vehicle);
    }

    /**
     * Get the vehicle that the refuel belongs to.
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle', 'id', 'vehicle_id');
    }
}
