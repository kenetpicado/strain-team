<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPromoterRequest;
use App\Models\Promoter;
use App\Notifications\RegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterPromoterController extends Controller
{
    public function __invoke(RegisterPromoterRequest $request)
    {
        $promoter = Promoter::create([
            'name' => $request->name,
            'email' => $request->email,
            'fee' => $request->fee ?? 0,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('promoter')->login($promoter);

        $promoter->notify(new RegisterNotification());

        return response()->json([
            'message' => 'Promoter created successfully',
            'user' => $promoter,
            'auth_token' => $promoter->createToken('authToken')->plainTextToken,
        ]);
    }
}
