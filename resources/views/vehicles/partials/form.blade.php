{{-- resources/views/vehicles/partials/form.blade.php --}}
<div>
    <label for="vehicle_type_id" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
    <select id="vehicle_type_id" name="vehicle_type_id" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        <option value="">Select a type</option>
        @foreach ($vehicleTypes as $type)
            <option value="{{ $type->id }}" @selected(old('vehicle_type_id', $vehicle?->vehicle_type_id) == $type->id)>
                {{ $type->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="registration_number" class="block text-sm font-medium text-gray-700">Registration Number</label>
    <input id="registration_number" name="registration_number" type="text"
        value="{{ old('registration_number', $vehicle?->registration_number) }}" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
        <input id="make" name="make" type="text" value="{{ old('make', $vehicle?->make) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
    </div>
    <div>
        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
        <input id="model" name="model" type="text" value="{{ old('model', $vehicle?->model) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
        <input id="year" name="year" type="number" value="{{ old('year', $vehicle?->year) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
    </div>
    <div>
        <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
        <input id="capacity" name="capacity" type="number" value="{{ old('capacity', $vehicle?->capacity) }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
    </div>
</div>

<div>
    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
    <select id="status" name="status" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        @foreach (\App\Enums\VehicleStatus::cases() as $status)
            <option value="{{ $status->value }}" @selected(old('status', $vehicle?->status?->value) === $status->value)>
                {{ $status->label() }}
            </option>
        @endforeach
    </select>
</div>