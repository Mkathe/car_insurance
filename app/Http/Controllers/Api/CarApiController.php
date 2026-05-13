<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CarApiController extends Controller
{
    public function index()
    {
        $cars = Car::with(['owner', 'photos'])
            ->latest()
            ->paginate(15);

        return response()->json($cars);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reg_number' => ['required', 'string', 'max:255', 'unique:cars,reg_number'],
            'brand'      => ['required', 'string', 'max:255'],
            'model'      => ['required', 'string', 'max:255'],
            'owner_id'   => ['required', 'integer', 'exists:owners,id'],

            'photos'     => ['nullable', 'array'],
            'photos.*'   => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $car = Car::create([
            'reg_number' => $data['reg_number'],
            'brand'      => $data['brand'],
            'model'      => $data['model'],
            'owner_id'   => $data['owner_id'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo'  => $path,
                ]);
            }
        }

        $car->load(['owner', 'photos']);

        return response()->json([
            'message' => 'Car created successfully.',
            'data' => $car,
        ], 201);
    }

    public function show(Car $car)
    {
        $car->load(['owner', 'photos']);

        return response()->json([
            'data' => $car,
        ]);
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'reg_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cars', 'reg_number')->ignore($car->id),
            ],
            'brand'      => ['required', 'string', 'max:255'],
            'model'      => ['required', 'string', 'max:255'],
            'owner_id'   => ['required', 'integer', 'exists:owners,id'],

            'photos'     => ['nullable', 'array'],
            'photos.*'   => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $car->update([
            'reg_number' => $data['reg_number'],
            'brand'      => $data['brand'],
            'model'      => $data['model'],
            'owner_id'   => $data['owner_id'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo'  => $path,
                ]);
            }
        }

        $car->load(['owner', 'photos']);

        return response()->json([
            'message' => 'Car updated successfully.',
            'data' => $car,
        ]);
    }

    public function destroy(Car $car)
    {
        $car->load('photos');

        foreach ($car->photos as $photo) {
            if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
                Storage::disk('public')->delete($photo->photo);
            }

            $photo->delete();
        }

        $car->delete();

        return response()->json([
            'message' => 'Car deleted successfully.',
        ]);
    }

    public function deletePhoto(CarPhoto $photo)
    {
        if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }

        $photo->delete();

        return response()->json([
            'message' => 'Photo deleted successfully.',
        ]);
    }
}
