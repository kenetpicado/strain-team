<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StudentRequest;
use App\Models\Student;
use App\Services\BranchService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate();

        return inertia('Dashboard/Students/Index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/Students/Create', [
            'branches' => (new BranchService)->getCurrents()
        ]);
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->validated());

        return back();
    }

    public function edit(Student $student)
    {
        return inertia('Dashboard/Students/Create', [
            'student' => $student,
            'branches' => (new BranchService)->getCurrents()
        ]);
    }

    public function update(StudentRequest $request, $student)
    {
        Student::where('id', $student)->update($request->validated());

        return back();
    }
}
