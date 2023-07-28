<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Promoter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $user = Promoter::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return abort(401, trans('auth.failed'));
        }

        $user->tokens()->delete();

        Auth::guard('promoter')->login($user);

        return response()->json([
            'message' => 'Login successful',
            'auth_token' => $user->createToken('authToken')->plainTextToken,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
