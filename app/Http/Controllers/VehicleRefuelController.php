<?php

namespace App\Http\Controllers;

use App\Refuel;
use App\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VehicleRefuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Vehicle  $vehicle
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Vehicle $vehicle, Request $request)
    {
        $request->validate([
            'trip_distance' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'fuel_amount' => ['required', 'numeric', 'min:0', 'max:100'],
            'fuel_unit_price' => ['required', 'numeric', 'min:0', 'max:100'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'max:255'],
        ]);

        $refuel = new Refuel();
        $refuel->vehicle_id = $vehicle->id;
        $refuel->trip_distance = $request->get('trip_distance');
        $refuel->fuel_amount = $request->get('fuel_amount');
        $refuel->fuel_unit_price = $request->get('fuel_unit_price');
        $refuel->date = $request->get('date');

        $refuel->save();

        return redirect()->route('vehicles.show', $vehicle->id)->with(['status' => 'Refuel is successfully added to the vehicle.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Refuel  $refuel
     * @return void
     */
    public function show(Refuel $refuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Refuel  $refuel
     * @return void
     */
    public function edit(Refuel $refuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Refuel  $refuel
     * @return void
     */
    public function update(Request $request, Refuel $refuel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Refuel  $refuel
     * @return void
     */
    public function destroy(Refuel $refuel)
    {
        //
    }
}
