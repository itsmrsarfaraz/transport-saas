<?php

namespace App\Http\Controllers;

use App\Http\Requests\Driver\DriverProfileRequest;
use App\Models\DriverProfile;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DriverProfileController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', DriverProfile::class);

        $drivers = DriverProfile::with(['user', 'vehicles', 'documents.documentType'])
            ->latest()
            ->paginate(15);

        return view('drivers.index', compact('drivers'));
    }

    public function create(): View
    {
        $this->authorize('create', DriverProfile::class);

        $users = User::whereHas('role', fn ($q) => $q->where('slug', 'driver'))
            ->whereDoesntHave('driverProfile')
            ->orderBy('name')
            ->get();

        $vehicles = Vehicle::orderBy('registration_number')->get();

        return view('drivers.create', compact('users', 'vehicles'));
    }

    public function store(DriverProfileRequest $request): RedirectResponse
    {
        $this->authorize('create', DriverProfile::class);

        $driverProfile = DriverProfile::create($request->safe()->except('vehicle_ids'));

        $driverProfile->vehicles()->sync($request->validated('vehicle_ids', []));

        return redirect()->route('drivers.index')->with('status', 'Driver profile created.');
    }

    public function edit(DriverProfile $driver): View
    {
        $this->authorize('update', $driver);

        $vehicles = Vehicle::orderBy('registration_number')->get();
        $assignedVehicleIds = $driver->vehicles->pluck('id')->toArray();

        return view('drivers.edit', compact('driver', 'vehicles', 'assignedVehicleIds'));
    }

    public function update(DriverProfileRequest $request, DriverProfile $driver): RedirectResponse
    {
        $this->authorize('update', $driver);

        $driver->update($request->safe()->except('vehicle_ids'));

        $driver->vehicles()->sync($request->validated('vehicle_ids', []));

        return redirect()->route('drivers.index')->with('status', 'Driver profile updated.');
    }

    public function destroy(DriverProfile $driver): RedirectResponse
    {
        $this->authorize('delete', $driver);

        $driver->delete();

        return redirect()->route('drivers.index')->with('status', 'Driver profile removed.');
    }
}