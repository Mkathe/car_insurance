@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('cars.car_details', ['id' => $car->id]) }}</h2>
        <div>
            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">{{ __('cars.edit') }}</a>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('cars.back') }}</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>{{ __('cars.reg_number') }}:</strong> {{ $car->reg_number }}</p>
            <p class="mb-1"><strong>{{ __('cars.brand') }}:</strong> {{ $car->brand }}</p>
            <p class="mb-0"><strong>{{ __('cars.model') }}:</strong> {{ $car->model }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Car Photos</div>

        <div class="card-body">
            @if($car->photos->isEmpty())
                <div class="alert alert-info mb-0">No photos uploaded for this car.</div>
            @else
                <div class="row">
                    @foreach($car->photos as $photo)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $photo->photo) }}"
                                 alt="Car photo"
                                 class="img-fluid rounded border"
                                 style="width: 100%; height: 180px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if($car->owner)
        <div class="card">
            <div class="card-header">{{ __('cars.owner') }}</div>
            <div class="card-body">
                <p class="mb-0">{{ $car->owner->surname }} {{ $car->owner->name }}</p>
                <a href="{{ route('owners.show', $car->owner) }}" class="btn btn-sm btn-outline-primary mt-2">
                    {{ __('cars.open_owner_page') }}
                </a>
            </div>
        </div>
    @endif
@endsection
