<?php

namespace App\Http\Controllers\API\Promoter\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => Student::query()
                ->where('promoter_id', auth()->id())
                ->branch($request->branch)
                ->select(['id', 'name', 'birth', 'id_number', 'card_number', 'phone', 'tutor', 'degree', 'branch_id'])
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
            'message' => trans('crud.created'),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return response()->json([
            'message' => trans('crud.updated'),
        ]);
    }
}
