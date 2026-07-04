{{-- resources/views/auth/verify-email.blade.php --}}
<x-layouts.guest>
    <h1 class="text-lg font-semibold text-gray-800 mb-4">Verify your email</h1>

    <p class="text-sm text-gray-600 mb-6">
        Thanks for signing up! Before getting started, check your email for a verification link.
        Didn't receive it? We'll gladly send another.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-200 text-sm text-green-700">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="text-sm text-blue-600 hover:underline">
                Resend verification email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:underline">
                Log out
            </button>
        </form>
    </div>
</x-layouts.guest>