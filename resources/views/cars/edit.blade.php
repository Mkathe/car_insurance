@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Edit Car</h2>

    <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{__('cars.reg_number')}}</label>
            <input type="text" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror"
                   value="{{ old('reg_number', $car->reg_number) }}">
            @error('reg_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{__('cars.brand')}}</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand', $car->brand) }}">
            @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{__('cars.model')}}</label>
            <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"
                   value="{{ old('model', $car->model) }}">
            @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{__('cars.owner')}}</label>
            <select name="owner_id" class="form-select @error('owner_id') is-invalid @enderror" required>
                <option value="" disabled>Select owner</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}"
                        @selected(old('owner_id', $car->owner_id) == $owner->id)>
                        {{ $owner->surname }} {{ $owner->name }}
                    </option>
                @endforeach
            </select>
            @error('owner_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Car Photos</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

            @error('photos.*')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <small class="text-muted">
                You can upload more than one photo.
            </small>
        </div>

        @if($car->owner)
            <div class="card mb-3">
                <div class="card-header">Owner information</div>
                <div class="card-body">
                    <p class="mb-1"><strong>ID:</strong> {{ $car->owner->id }}</p>
                    <p class="mb-0"><strong>{{__('register.name')}}:</strong> {{ $car->owner->surname }} {{ $car->owner->name }}</p>
                    <a class="btn btn-sm btn-outline-primary mt-2" href="{{ route('owners.show', $car->owner) }}">
                        Open owner page
                    </a>
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">{{__('cars.edit')}}</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{__('cars.back')}}</a>
    </form>

    <hr class="my-4">

    <h4 class="mb-3">Car Photos</h4>

    @if($car->photos->isEmpty())
        <div class="alert alert-info">No photos uploaded for this car.</div>
    @else
        <div class="row">
            @foreach($car->photos as $photo)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $photo->photo) }}"
                             class="card-img-top"
                             alt="Car photo"
                             style="height: 180px; object-fit: cover;">

                        <div class="card-body text-center">
                            <form action="{{ route('cars.photos.delete', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this photo?')">
                                    Delete Photo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <h4 class="mb-3">Cars</h4>

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
                    <td>{{ $car->owner?->surname }} {{ $car->owner?->name }}</td>
                    <td>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">{{__('cars.view')}}</a>
                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">{{__('cars.edit')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
