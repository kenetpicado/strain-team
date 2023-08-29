<?php

namespace App\Http\Controllers\API\Student\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json([
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        Student::where('id', auth()->id())->update($request->validated());

        return response()->json([
            'message' => trans('crud.updated'),
        ]);
    }
}
