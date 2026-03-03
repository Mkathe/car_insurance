@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cars</h2>
        <a href="{{ route('cars.create') }}" class="btn btn-primary">Add Car</a>
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
                    <td>
                        @if($car->owner)
                            <a href="{{ route('owners.show', $car->owner) }}">
                                {{ $car->owner->name }} {{ $car->owner->surname }}
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this car?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $cars->links() }}
    @endif
@endsection
