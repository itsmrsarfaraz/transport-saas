{{-- resources/views/drivers/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drivers - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen">
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <span class="font-semibold text-gray-800">{{ config('app.name') }}</span>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-lg font-semibold text-gray-800">Drivers</h1>
            <a href="{{ route('drivers.create') }}"
                class="bg-gray-900 text-white text-sm px-4 py-2 rounded-md hover:bg-gray-800 transition">
                Add Driver Profile
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
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">License</th>
                        <th class="px-4 py-3">Vehicles</th>
                        <th class="px-4 py-3">Documents</th>
                        <th class="px-4 py-3">Available</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($drivers as $driver)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $driver->user->name }}</td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $driver->license_number ?? '—' }}
                                @if ($driver->license_expiry)
                                    <span class="text-xs text-gray-400">(exp. {{ $driver->license_expiry->format('M Y') }})</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $driver->vehicles->pluck('registration_number')->join(', ') ?: '—' }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                @php $expiredCount = $driver->documents->filter->isExpired()->count(); @endphp
                                {{ $driver->documents->count() }} on file
                                @if ($expiredCount > 0)
                                    <span class="text-xs text-red-600">({{ $expiredCount }} expired)</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($driver->is_available)
                                    <span class="inline-block px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs">Yes</span>
                                @else
                                    <span class="inline-block px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 text-xs">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('drivers.edit', $driver) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('drivers.destroy', $driver) }}" class="inline"
                                    onsubmit="return confirm('Remove this driver profile?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">No driver profiles yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $drivers->links() }}
        </div>
    </main>
</body>
</html>