@extends('layouts.app')

@section('title', $vehicle->name.' - '.__('My vehicles'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('partials.alerts')

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <b class="mr-auto">{{ __('Vehicle: ').$vehicle->name }}</b>
                            <a class="btn btn-light ml-1" href="{{ route('vehicles.index') }}">{{ __('Back') }}</a>
                            <a class="btn btn-secondary ml-1" href="{{ route('vehicles.edit', $vehicle->id) }}">{{ __('Edit') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Name: </strong>
                            {{ $vehicle->name }}<br>
                            <strong>Fuel type: </strong>
                            {{ $vehicle->fuel_type }}<br>
                            <strong>Initial odometer value: </strong>
                            {{ (int)$vehicle->initial_odo }}<br>
                            <strong>Notes: </strong>
                            {{ $vehicle->notes }}<br>
                        </p>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
