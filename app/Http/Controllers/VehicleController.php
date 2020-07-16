<?php

namespace App\Http\Controllers;

use App\Fuel;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $vehicles = Vehicle::FromCurrentUser()->get();

        return view('vehicles.index')->with([
            'user' => Auth::user(),
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vehicles.create')->with([
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'fuel_type' => ['required', Rule::in(Fuel::TYPES)],
            'odo' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'notes' => ['nullable', 'max:255'],
        ]);

        $vehicle = new Vehicle();
        $vehicle->user_id = Auth::id();
        $vehicle->name = $request->get('name');
        $vehicle->fuel_type = $request->get('fuel_type');
        $vehicle->initial_odo = $request->get('odo');
        $vehicle->notes = $request->get('notes');

        $vehicle->save();

        return redirect()->route('vehicles.show', $vehicle->id)->with(['status'=> 'Vehicle is successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show')->with([
            'user' => Auth::user(),
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vehicle  $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit')->with([
            'user' => Auth::user(),
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'fuel_type' => ['required', Rule::in(Fuel::TYPES)],
            'odo' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'notes' => ['nullable', 'max:255'],
        ]);

        $vehicle->name = $request->get('name');
        $vehicle->fuel_type = $request->get('fuel_type');
        $vehicle->initial_odo = $request->get('odo');
        $vehicle->notes = $request->get('notes');

        $vehicle->save();

        return redirect()->route('vehicles.show', $vehicle->id)->with(['status'=> 'Vehicle is successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vehicle $vehicle)
    {
        if (! $vehicle->delete()) {
            return back()->withErrors(['status' => __('Could not delete the specified vehicle!')]);
        }

        return redirect()->route('vehicles.index')->with(['status'=> 'Vehicle is successfully deleted.']);
    }
}
