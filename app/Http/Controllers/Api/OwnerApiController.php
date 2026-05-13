<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerApiController extends Controller
{
    public function index()
    {
        $owners = Owner::with('cars')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $owners,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
        ]);

        $owner = Owner::create($data);

        return response()->json([
            'message' => 'Owner created successfully.',
            'data' => $owner,
        ], 201);
    }

    public function show(Owner $owner)
    {
        $owner->load(['cars.photos']);

        return response()->json([
            'data' => $owner,
        ]);
    }

    public function update(Request $request, Owner $owner)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
        ]);

        $owner->update($data);

        return response()->json([
            'message' => 'Owner updated successfully.',
            'data' => $owner,
        ]);
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return response()->json([
            'message' => 'Owner deleted successfully.',
        ]);
    }
}
