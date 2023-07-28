<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TeacherRequest;
use App\Services\PasswordService;
use App\Models\Branch;
use App\Models\Teacher;
use App\Notifications\RegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $branches = auth()->user()->branch_id ?? Branch::all(['id', 'name']);

        return inertia('Dashboard/Teachers/Index', [
            'teachers' => Teacher::query()
                ->addSelect([
                    'branch' => Branch::select('name')
                        ->whereColumn('branch_id', 'branches.id')
                        ->limit(1)
                ])
                ->get(),
            'branches' => $branches
        ]);
    }

    public function store(TeacherRequest $request)
    {
        $password = (new PasswordService)->generate();

        $teacher = Teacher::create($request->validated() + [
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        $teacher->notify(new RegisterNotification($password));

        return back();
    }

    public function update(TeacherRequest $request, $teacher)
    {
        Teacher::where('id', $teacher)->update($request->validated());

        return back();
    }
}
