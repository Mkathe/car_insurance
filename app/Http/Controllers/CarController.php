<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('owner')->latest()->paginate(15);
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $owners = Owner::orderBy('surname')->orderBy('name')->get(['id', 'name', 'surname']);
        return view('cars.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reg_number' => ['required', 'string', 'max:255', 'unique:cars,reg_number'],
            'brand'      => ['required', 'string', 'max:255'],
            'model'      => ['required', 'string', 'max:255'],
            'owner_id'   => ['required', 'integer', 'exists:owners,id'],
        ]);

        $car = Car::create($data);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo'  => $path,
                ]);
            }
        }

        return redirect()->route('cars.show', $car)->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        $car->load('owner', 'photos');
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $car->load('owner','photos');
        $owners = Owner::orderBy('surname')->orderBy('name')->get(['id', 'name', 'surname']);

        return view('cars.edit', compact('car', 'owners'));
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'reg_number' => ['required', 'string', 'max:255', 'unique:cars,reg_number,' . $car->id],
            'brand'      => ['required', 'string', 'max:255'],
            'model'      => ['required', 'string', 'max:255'],
            'owner_id'   => ['required', 'integer', 'exists:owners,id'],
        ]);

        $car->update($data);
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('cars', 'public');

                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo'  => $path,
                ]);
            }
        }

        return redirect()->route('cars.show', $car)->with('success', 'Car updated successfully.');
    }

    public function deletePhoto($id)
    {
        $photo = CarPhoto::findOrFail($id);

        if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }

        $photo->delete();

        return redirect()
            ->back()
            ->with('success', 'Photo deleted successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
