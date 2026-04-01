@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{__('owners.owners')}}</h2>
        <a href="{{ route('owners.create') }}" class="btn btn-primary">{{__('owners.add_owner')}}</a>
    </div>

    @if($owners->isEmpty())
        <div class="alert alert-info">{{__('owners.no_owners_found')}}</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{__('owners.name')}}</th>
                <th>{{__('owners.surname')}}</th>
                <th width="220">{{__('owners.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($owners as $owner)
                <tr>
                    <td>{{ $owner->id }}</td>
                    <td>{{ $owner->name }}</td>
                    <td>{{ $owner->surname }}</td>
                    <td>
                        <a href="{{ route('owners.show', $owner) }}" class="btn btn-sm btn-info">{{__('owners.view')}}</a>
                        <a href="{{ route('owners.edit', $owner) }}" class="btn btn-sm btn-warning">{{__('owners.edit')}}</a>

                        <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this owner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">{{__('owners.delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
