{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen">
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <span class="font-semibold text-gray-800">{{ config('app.name') }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Log out</button>
        </form>
    </nav>

    <main class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h1 class="text-lg font-semibold text-gray-800">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-sm text-gray-600 mt-1">
                Role: <span class="font-medium">{{ auth()->user()->role?->name ?? 'No role assigned' }}</span>
            </p>
        </div>
    </main>
</body>
</html>