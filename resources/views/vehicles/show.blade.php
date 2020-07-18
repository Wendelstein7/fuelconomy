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
                            {{ number_format($vehicle->initial_odo) }}<br>
                            <strong>Date added: </strong>
                            <time datetime="{{ $vehicle->created_at->toW3cString() }}">{{ $vehicle->created_at->toFormattedDateString() }}</time>
                            <br>
                            @if($vehicle->notes)
                                <strong>Notes: </strong>
                                {{ $vehicle->notes }}<br>
                            @endif
                        </p>

                        <hr>

                        <form action="{{ route('vehicles.refuels.store', $vehicle->id) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg mb-3">
                                    <div class="form-group mb-0">
                                        <label for="trip_distance">Trip Distance</label>
                                        <div class="input-group @error('trip_distance') is-invalid @enderror">
                                            <input type="number" min="0" max="1000000" step="0.001" class="form-control @error('trip_distance') is-invalid @enderror" id="trip_distance" name="trip_distance" placeholder="750" value="{{ old('trip_distance') }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">km</div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('trip_distance')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg mb-3">
                                    <div class="form-group mb-0">
                                        <label for="fuel_amount">Fuel amount</label>
                                        <div class="input-group @error('fuel_amount') is-invalid @enderror">
                                            <input type="number" min="0" max="100" step="0.001" class="form-control @error('fuel_amount') is-invalid @enderror" id="fuel_amount" name="fuel_amount" placeholder="35" value="{{ old('fuel_amount') }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ \App\Fuel::UNITS[$vehicle->fuel_type]['short'] }}</div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('fuel_amount')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg mb-3">
                                    <div class="form-group mb-0">
                                        <label for="fuel_unit_price">Fuel price</label>
                                        <div class="input-group @error('fuel_unit_price') is-invalid @enderror">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">€</div>
                                            </div>
                                            <input type="number" min="0" max="100" step="0.001" class="form-control @error('fuel_unit_price') is-invalid @enderror" id="fuel_unit_price" name="fuel_unit_price" placeholder="1.50" value="{{ old('fuel_unit_price') }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">/ {{ \App\Fuel::UNITS[$vehicle->fuel_type]['short'] }}</div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            @error('fuel_unit_price')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg mb-3">
                                    <div class="form-group mb-0">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') ?? \Carbon\Carbon::now()->toDateString() }}" required>
                                        <div class="invalid-feedback">
                                            @error('date')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="submit" type="submit">Submit refuel</button>
                        </form>

                        <hr>

                        @if($refuels->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('No refuels registered for this vehicle! Add a refuel below.') }}
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    @foreach($refuels as $refuel)
                                        <tr style="background-color: #eeeeee">
                                            <td>
                                                @if($vehicle->fuel_type === \App\Fuel::ELECTRICITY)
                                                    <i class="fas fa-charging-station"></i>
                                                @else
                                                    <i class="fas fa-gas-pump"></i>
                                                @endif
                                                Refuel:
                                                <time datetime="{{ $refuel->date->toW3cString() }}">{{ \App\FriendlyFormat::date($refuel->date) }}</time>
                                            </td>
                                            <td>
                                                <b>{{ number_format($refuel->fuel_amount, 1) }}</b> {{ \App\Fuel::UNITS[$vehicle->fuel_type]['short'] }}
                                            </td>
                                            <td>
                                                € <b>{{ number_format($refuel->fuel_unit_price, 2) }}</b> / {{ \App\Fuel::UNITS[$vehicle->fuel_type]['short'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-1 pl-3 pb-3"><i>Trip:</i> {{ number_format($refuel->trip_distance) }} km</td>
                                            <td class="pt-1">
                                                <b>{{ number_format($refuel->trip_distance / $refuel->fuel_amount, 1) }}</b> km / {{ \App\Fuel::UNITS[$vehicle->fuel_type]['short'] }}
                                            </td>
                                            <td class="pt-1">
                                                € <b>{{ number_format(($refuel->fuel_amount * $refuel->fuel_unit_price) / $refuel->trip_distance, 2) }}</b> / km
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $refuels->links() !!}

                        @endif


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
