<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\BranchEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Groups/Index', [
            'groups' => Group::query()
                ->addSelect([
                    "course" => Course::select('name')->whereColumn('course_id', 'courses.id')->limit(1),
                    "teacher" => Teacher::select('name')->whereColumn('teacher_id', 'teachers.id')->limit(1)
                ])
                ->get()
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/Groups/Create', [
            'branches' => BranchEnum::cases(),
            'teachers' => DB::table('teachers')->get(['id', 'name']),
            'courses' => DB::table('courses')->get(['id', 'name'])
        ]);
    }

    public function store(GroupRequest $request)
    {
        Group::create($request->validated());

        return back();
    }

    public function update(GroupRequest $request, $group)
    {
        Group::where('id', $group)->update($request->validated());

        return back();
    }
}
