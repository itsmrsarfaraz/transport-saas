{{-- resources/views/auth/forgot-password.blade.php --}}
<x-layouts.guest>
    <h1 class="text-lg font-semibold text-gray-800 mb-4">Forgot your password?</h1>

    <p class="text-sm text-gray-600 mb-6">
        Enter your email and we'll send you a link to reset your password.
    </p>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-md bg-red-50 border border-red-200 text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-200 text-sm text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <button type="submit"
            class="w-full bg-gray-900 text-white rounded-md py-2 text-sm font-medium hover:bg-gray-800 transition">
            Email Password Reset Link
        </button>
    </form>

    <p class="text-sm text-gray-600 mt-6 text-center">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Back to login</a>
    </p>
</x-layouts.guest>