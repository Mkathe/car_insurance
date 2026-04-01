@extends('layouts.app')

@section('content')
    <h2 class="mb-3">{{__('owners.add_owner')}}</h2>

    <form action="{{ route('owners.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{__('owners.name')}}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{__('owners.surname')}}</label>
            <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                   value="{{ old('surname') }}">
            @error('surname')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{__('owners.save')}}</button>
        <a href="{{ route('owners.index') }}" class="btn btn-secondary">{{__('owners.back')}}</a>
    </form>
@endsection
