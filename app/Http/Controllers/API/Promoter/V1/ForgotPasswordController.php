<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoterForgotPasswordRequest;
use App\Http\Services\ForgotPasswordService;
use App\Models\Promoter;
use App\Notifications\ForgotPasswordNotification;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function __invoke(PromoterForgotPasswordRequest $request)
    {
        $promoter = Promoter::where('email', $request->email)->first();

        $password = (new ForgotPasswordService)($promoter);

        $promoter->notify(new ForgotPasswordNotification($password));

        return response()->json([
            'message' => 'Please check your email for new password',
        ]);
    }
}
