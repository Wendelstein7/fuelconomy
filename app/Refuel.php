<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int vehicle_id Vehicle that was refueled
 * @property float trip_distance Distance traveled since last refuel
 * @property float fuel_amount Amount of fuel units refueled
 * @property float fuel_unit_price Fuel price per unit
 * @property Carbon date The date the refuel happened
 * @property string notes Notes
 * @property Carbon created_at
 * @property Carbon updated_at
 */
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    /**
     * Scope a query to only include refuels that belong to a given vehicle.
     *
     * @param  Builder  $query
     * @param  mixed  $vehicle
     * @return Builder
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
