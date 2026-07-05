{{-- resources/views/terms.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Conditions - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100 min-h-screen">
    <main class="max-w-3xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 prose">
            <h1 class="text-xl font-semibold text-gray-800 mb-4">Terms & Conditions</h1>
            <p class="text-sm text-gray-600">
                Placeholder content — this page must be reviewed by legal counsel per operating
                jurisdiction before production launch. This platform is designed for multi-country
                deployment, so terms may need to vary by tenant/region.
            </p>
        </div>
    </main>
</body>
</html>