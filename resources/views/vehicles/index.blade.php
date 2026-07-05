{{-- resources/views/vehicles/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicles - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen">
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <span class="font-semibold text-gray-800">{{ config('app.name') }}</span>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
    </nav>

    <main class="max-w-5xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-lg font-semibold text-gray-800">Vehicles</h1>
            <a href="{{ route('vehicles.create') }}"
                class="bg-gray-900 text-white text-sm px-4 py-2 rounded-md hover:bg-gray-800 transition">
                Add Vehicle
            </a>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-200 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Registration</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Make / Model</th>
                        <th class="px-4 py-3">Capacity</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $vehicle->registration_number }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $vehicle->vehicleType->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $vehicle->make }} {{ $vehicle->model }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $vehicle->capacity }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $vehicle->status->label() }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('vehicles.edit', $vehicle) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('vehicles.destroy', $vehicle) }}" class="inline"
                                    onsubmit="return confirm('Delete this vehicle?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">No vehicles yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </main>
</body>
</html>