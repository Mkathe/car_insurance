@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Owner: {{ $owner->name }} {{ $owner->surname }}</h2>
        <div>
            <a href="{{ route('owners.edit', $owner) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('owners.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>ID:</strong> {{ $owner->id }}</p>
            <p class="mb-0"><strong>Full name:</strong> {{ $owner->name }} {{ $owner->surname }}</p>
        </div>
    </div>

    <h4 class="mb-3">Cars of this owner</h4>

    @if($owner->cars->isEmpty())
        <div class="alert alert-info">No cars found for this owner.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Reg #</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Owner (of this car)</th>
                <th width="220">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($owner->cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->reg_number }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->owner?->name }} {{ $car->owner?->surname }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
