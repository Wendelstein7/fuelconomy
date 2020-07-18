<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 * @property int user_id User owning the vehicle
 * @property string name Name of the vehicle
 * @property string fuel_type Fuel type consumed by the vehicle
 * @property int initial_odo The initial odometer value of the vehicle
 * @property string notes Notes
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Vehicle extends Model
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
     * Scope a query to only include vehicles that belong to the currently authenticated user.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeFromCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    /**
     * Get the user that the vehicle belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    /**
     * Get the refuels associated to the vehicle.
     */
    public function refuels()
    {
        return $this->hasMany('App\Refuel', 'vehicle_id', 'id');
    }
}
