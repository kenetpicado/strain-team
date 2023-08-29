<?php

namespace App\Http\Controllers\API\Student\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginStudentRequest;
use App\Models\Student;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginStudentRequest $request)
    {
        $user = (new AuthService)->login($request, Student::class, 'student', 'username');

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
