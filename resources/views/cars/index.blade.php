@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cars</h2>

        @if(auth()->user()->type === 'admin')
            <a href="{{ route('cars.create') }}" class="btn btn-primary">Add Car</a>
        @endif
    </div>

    @if($cars->isEmpty())
        <div class="alert alert-info">No cars found.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Reg #</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Owner</th>
                <th width="260">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->reg_number }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->owner->name ?? '' }} {{ $car->owner->surname ?? '' }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">View</a>

                        @if(auth()->user()->type === 'admin')
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
