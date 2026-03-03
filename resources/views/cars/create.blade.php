@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Add Car</h2>

    <form action="{{ route('cars.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Reg Number</label>
            <input type="text" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror"
                   value="{{ old('reg_number') }}">
            @error('reg_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand') }}">
            @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"
                   value="{{ old('model') }}">
            @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Owner</label>
            <select name="owner_id" class="form-select @error('owner_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select owner</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                        {{ $owner->surname }} {{ $owner->name }}
                    </option>
                @endforeach
            </select>
            @error('owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
