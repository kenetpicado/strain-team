<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoterProfileRequest;
use App\Models\Student;

class ProfileController extends Controller
{
    public function index()
    {
        $students = Student::query()->where('promoter_id', auth()->id())->get(['id', 'card_number']);
        $confirmed_students = $students->whereNotNull('card_number')->count();

        return response()->json([
            'data' => [
                'user' => auth()->user(),
                'total_students' => $students->count(),
                'confirmed_students' => $confirmed_students,
            ],
        ]);
    }

    public function update(PromoterProfileRequest $request)
    {
        auth()->user()->update($request->validated());

        return response()->json([
            'message' => 'Profile updated successfully',
        ]);
    }
}
