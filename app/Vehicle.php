<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromCurrentUser($query)
    {
        return $query->where('user_id',  Auth::id());
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
