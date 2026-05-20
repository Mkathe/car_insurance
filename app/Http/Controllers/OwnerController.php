<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $owners = Owner::with('cars')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $owners = Owner::with('cars')
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Owner::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Owner::create($validated);

        return redirect()->route('owners.index')->with('success', 'Owner created successfully.');
    }

    public function show(Owner $owner)
    {
        $this->authorize('view', $owner);

        $owner->load(['cars.owner']);

        return view('owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        $this->authorize('update', $owner);

        $owner->load(['cars.owner']);

        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $this->authorize('update', $owner);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        $owner->update($validated);

        return redirect()->route('owners.index')->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $this->authorize('delete', $owner);

        $owner->delete();

        return redirect()->route('owners.index')->with('success', 'Owner deleted successfully.');
    }
}
