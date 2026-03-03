<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Owner;
use Illuminate\Http\Request;

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

        return redirect()->route('cars.show', $car)->with('success', 'Car created successfully.');
    }

    public function show(Car $car)
    {
        $car->load('owner');
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $car->load('owner');
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

        return redirect()->route('cars.show', $car)->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
