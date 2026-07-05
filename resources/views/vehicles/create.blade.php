{{-- resources/views/vehicles/create.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Vehicle - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen">
    <main class="max-w-lg mx-auto p-6">
        <h1 class="text-lg font-semibold text-gray-800 mb-6">Add Vehicle</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-md bg-red-50 border border-red-200 text-sm text-red-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('vehicles.store') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
            @csrf
            @include('vehicles.partials.form', ['vehicle' => null])

            <button type="submit" class="w-full bg-gray-900 text-white rounded-md py-2 text-sm font-medium hover:bg-gray-800 transition">
                Save Vehicle
            </button>
        </form>
    </main>
</body>
</html>