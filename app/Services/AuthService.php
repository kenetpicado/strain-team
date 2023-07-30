<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function login($request, $model, $guard)
    {
        $request->ensureIsNotRateLimited();

        $user = $model::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $request->hit();

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->clear();

        $user->tokens()->delete();

        Auth::guard($guard)->login($user);

        return $user;
    }
}
