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
                            <a class="btn btn-light ml-1" href="{{ route('vehicles.show', $vehicle->id) }}">{{ __('Cancel') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <form name="edit" id="form" method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" maxlength="255" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Fabulous White Citroën C1" value="{{ old('name') ?? $vehicle->name }}" required>
                                <div class="invalid-feedback">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fuel_type">Fuel type</label>
                                <select class="form-control @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type" required>
                                    @foreach(\App\Fuel::TYPES as $type)
                                        <option @if($type === old('fuel_type') ?? $vehicle->fuel_type) selected @endif>{{ $type }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('fuel_type')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="odo">Initial odometer value</label>
                                <div class="input-group @error('odo') is-invalid @enderror">
                                    <input type="number" min="0" max="1000000" step="1" class="form-control @error('odo') is-invalid @enderror" id="odo" name="odo" placeholder="150000" value="{{ old('odo') ?? (int)$vehicle->initial_odo }}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">KM</div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    @error('odo')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea maxlength="255" class="form-control @error('notes') is-invalid @enderror " id="notes" name="notes" placeholder="..." rows="2">{{ old('notes') ?? $vehicle->notes }}</textarea>
                                <div class="invalid-feedback">
                                    @error('notes')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Save vehicle</button>
                            <button class="btn btn-outline-danger" onclick="$('input[name=\'_method\']').val('DELETE');$('#form').submit();">Delete vehicle</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
