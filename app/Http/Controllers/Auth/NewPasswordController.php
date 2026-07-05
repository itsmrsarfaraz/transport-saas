<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function create(string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => request()->query('email', ''),
        ]);
    }

    public function store(NewPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->validated(),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->validated('password')),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}