@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Car #{{ $car->id }}</h2>
        <div>
            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>Reg #:</strong> {{ $car->reg_number }}</p>
            <p class="mb-1"><strong>Brand:</strong> {{ $car->brand }}</p>
            <p class="mb-0"><strong>Model:</strong> {{ $car->model }}</p>
        </div>
    </div>

    @if($car->owner)
        <div class="card">
            <div class="card-header">Owner</div>
            <div class="card-body">
                <p class="mb-0">{{ $car->owner->surname }} {{ $car->owner->name }}</p>
                <a href="{{ route('owners.show', $car->owner) }}" class="btn btn-sm btn-outline-primary mt-2">
                    Open owner page
                </a>
            </div>
        </div>
    @endif
@endsection
