@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('cars.cars') }}</h2>

        @if(auth()->user()->type === 'admin')
            <a href="{{ route('cars.create') }}" class="btn btn-primary">{{ __('cars.add_car') }}</a>
        @endif
    </div>

    @if($cars->isEmpty())
        <div class="alert alert-info">{{ __('cars.no_cars_found') }}</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>{{ __('cars.id') }}</th>
                <th>Photos</th>
                <th>{{ __('cars.reg_number') }}</th>
                <th>{{ __('cars.brand') }}</th>
                <th>{{ __('cars.model') }}</th>
                <th>{{ __('cars.owner') }}</th>
                <th width="260">{{ __('cars.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td style="max-width: 320px;">
                        @if($car->photos->isNotEmpty())
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($car->photos as $photo)
                                    <img src="{{ asset('storage/' . $photo->photo) }}"
                                         alt="Car photo"
                                         style="width: 90px; height: 60px; object-fit: cover; border-radius: 6px;">
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted">No photo</span>
                        @endif
                    </td>
                    <td>{{ $car->reg_number }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->owner->name ?? '' }} {{ $car->owner->surname ?? '' }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">{{ __('cars.view') }}</a>

                        @if(auth()->user()->type === 'admin')
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">{{ __('cars.edit') }}</a>

                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">{{ __('cars.delete') }}</button>
                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
