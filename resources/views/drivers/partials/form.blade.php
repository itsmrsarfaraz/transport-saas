{{-- resources/views/drivers/partials/form.blade.php --}}
@if (! $driver)
    <div>
        <label for="user_id" class="block text-sm font-medium text-gray-700">User (must have role: driver)</label>
        <select id="user_id" name="user_id" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <option value="">Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
        @if ($users->isEmpty())
            <p class="text-xs text-gray-500 mt-1">No unassigned users with the "driver" role found.</p>
        @endif
    </div>
@endif

<div>
    <label for="license_number" class="block text-sm font-medium text-gray-700">License Number</label>
    <input id="license_number" name="license_number" type="text"
        value="{{ old('license_number', $driver?->license_number) }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
</div>

<div>
    <label for="license_expiry" class="block text-sm font-medium text-gray-700">License Expiry</label>
    <input id="license_expiry" name="license_expiry" type="date"
        value="{{ old('license_expiry', $driver?->license_expiry?->format('Y-m-d')) }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
</div>

<div class="flex items-center">
    <input id="is_available" name="is_available" type="checkbox" value="1"
        @checked(old('is_available', $driver?->is_available ?? true))
        class="rounded border-gray-300 text-gray-900 focus:ring-gray-500">
    <label for="is_available" class="ml-2 text-sm text-gray-600">Available for assignment</label>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Assigned Vehicles</label>
    <div class="space-y-1 max-h-40 overflow-y-auto border border-gray-200 rounded-md p-3">
        @forelse ($vehicles as $vehicle)
            <label class="flex items-center text-sm text-gray-700">
                <input type="checkbox" name="vehicle_ids[]" value="{{ $vehicle->id }}"
                    @checked(in_array($vehicle->id, old('vehicle_ids', $assignedVehicleIds)))
                    class="rounded border-gray-300 text-gray-900 focus:ring-gray-500 mr-2">
                {{ $vehicle->registration_number }} ({{ $vehicle->vehicleType->name }})
            </label>
        @empty
            <p class="text-xs text-gray-500">No vehicles available yet.</p>
        @endforelse
    </div>
</div>