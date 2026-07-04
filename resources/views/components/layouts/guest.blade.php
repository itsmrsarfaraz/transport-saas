{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Transport SaaS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="text-center mb-6">
            <span class="text-2xl font-semibold text-gray-800">{{ config('app.name', 'Transport SaaS') }}</span>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-8 border border-gray-200">
            {{ $slot }}
        </div>
    </div>
</body>
</html>