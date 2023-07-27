<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Student::query()
                ->where('promoter_id', auth()->id())
                ->select(['id', 'name', 'birth', 'id_number', 'card_number', 'phone', 'tutor', 'degree'])
                ->paginate(),
        ]);
    }

    public function store(StudentRequest $request)
    {
        foreach ($request->validated() as $student) {
            Student::create($student + [
                'promoter_id' => auth()->id(),
            ]);
        }

        return response()->json([
            'message' => 'Student created successfully',
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return response()->json([
            'message' => 'Student updated successfully',
        ]);
    }
}
