@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Car Owners</h2>
        <a href="{{ route('owners.create') }}" class="btn btn-primary">Add Owner</a>
    </div>

    @if($owners->isEmpty())
        <div class="alert alert-info">No owners found.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th width="220">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($owners as $owner)
                <tr>
                    <td>{{ $owner->id }}</td>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->surname }}</td>
                    <td>
                        <a href="{{ route('owners.edit', $owner) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this owner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
