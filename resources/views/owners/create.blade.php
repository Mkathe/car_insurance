@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Add Car Owner</h2>

    <form action="{{ route('owners.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Surname</label>
            <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                   value="{{ old('surname') }}">
            @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('owners.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
