<?php

// app/Http/Controllers/VehicleController.php
namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\VehicleRequest;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Vehicle::class);

        $vehicles = Vehicle::with('vehicleType')
            ->latest()
            ->paginate(15);

        return view('vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        $this->authorize('create', Vehicle::class);

        $vehicleTypes = VehicleType::orderBy('name')->get();

        return view('vehicles.create', compact('vehicleTypes'));
    }

    public function store(VehicleRequest $request): RedirectResponse
    {
        $this->authorize('create', Vehicle::class);

        Vehicle::create($request->validated());

        return redirect()->route('vehicles.index')->with('status', 'Vehicle added successfully.');
    }

    public function edit(Vehicle $vehicle): View
    {
        $this->authorize('update', $vehicle);

        $vehicleTypes = VehicleType::orderBy('name')->get();

        return view('vehicles.edit', compact('vehicle', 'vehicleTypes'));
    }

    public function update(VehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('update', $vehicle);

        $vehicle->update($request->validated());

        return redirect()->route('vehicles.index')->with('status', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('status', 'Vehicle deleted.');
    }
}