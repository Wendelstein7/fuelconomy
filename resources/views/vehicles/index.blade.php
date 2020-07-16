@extends('layouts.app')

@section('title', __('My vehicles'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <b class="mr-auto">{{ __('My vehicles') }}</b>
                            <a class="btn btn-secondary ml-1" href="{{ route('vehicles.create') }}">{{ __('Add new vehicle') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($vehicles->isEmpty())
                            <div class="alert alert-info" role="alert">
                                {{ __('No vehicles registered here! Add a new vehicle using the button above.') }}
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    {{-- <caption>List of vehicles</caption> --}}
                                    {{--                                    <thead>--}}
                                    {{--                                    <tr>--}}
                                    {{--                                        <th scope="col">Name</th>--}}
                                    {{--                                        <th scope="col">Fuel</th>--}}
                                    {{--                                        <th scope="col">Notes</th>--}}
                                    {{--                                        <th scope="col"></th>--}}
                                    {{--                                    </tr>--}}
                                    {{--                                    </thead>--}}
                                    <tbody>
                                    @foreach($vehicles as $vehicle)
                                        <tr>
                                            <th scope="row"><a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->name }}</a></th>
                                            <td>{{ $vehicle->fuel_type }}</td>
                                            <td>{{ $vehicle->notes }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Actions">
                                                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
