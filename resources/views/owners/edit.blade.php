@extends('layouts.app')

@section('content')
    <h2 class="mb-3">{{__('owners.edit')}}} {{__('owners.owner')}}</h2>

    <form action="{{ route('owners.update', $owner) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{__('owners.name')}}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $owner->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{__('owners.surname')}}</label>
            <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                   value="{{ old('surname', $owner->surname) }}">
            @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('owners.index') }}" class="btn btn-secondary">{{__('owners.back')}}</a>
    </form>

    <hr class="my-4">

    <h4 class="mb-3">{{__('owners.cars_of_owner')}}</h4>

    @if($owner->cars->isEmpty())
        <div class="alert alert-info">{{__('owners.no_cars_found_by_owner')}}</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{__('owners.reg_number')}}</th>
                <th>{{__('owners.brand')}}</th>
                <th>{{__('owners.model')}}</th>
                <th>{{__('owners.owner')}}</th>
                <th width="220">{{__('owners.actions')}}</th>
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
