@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{__('owners.owner')}}: {{ $owner->name }} {{ $owner->surname }}</h2>
        <div>
            <a href="{{ route('owners.edit', $owner) }}" class="btn btn-warning">{{__('owners.edit')}}</a>
            <a href="{{ route('owners.index') }}" class="btn btn-secondary">{{__('owners.back')}}</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-1"><strong>ID:</strong> {{ $owner->id }}</p>
            <p class="mb-0"><strong>{{__('register.name')}}:</strong> {{ $owner->name }} {{ $owner->surname }}</p>
        </div>
    </div>

    <h4 class="mb-3">{{__('owners.cars_of_owner')}}</h4>

    @if($owner->cars->isEmpty())
        <div class="alert alert-info">{{__('owners.no_cars_found_by_owner')}}</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{__('cars.reg_number')}}</th>
                <th>{{__('cars.brand')}}</th>
                <th>{{__('cars.model')}}</th>
                <th>{{__('cars.owner')}}</th>
                <th width="220">{{__('cars.actions')}}</th>
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
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">{{__('owners.view')}}</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">{{__('owners.edit')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
