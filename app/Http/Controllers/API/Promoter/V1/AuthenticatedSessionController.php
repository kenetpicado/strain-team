<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Promoter;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request)
    {
        $user = (new AuthService)->login($request, Promoter::class, 'promoter');

        return response()->json([
            'message' => trans('auth.success'),
            'auth_token' => $user->createToken('authToken')->plainTextToken,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => trans('auth.logout')
        ]);
    }
}
