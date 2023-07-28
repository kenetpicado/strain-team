<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use App\Services\GroupService;
use App\Services\TeacherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function __construct(
        private readonly GroupService $groupService,
        private readonly TeacherService $teacherService
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/Groups/Index', [
            'groups' => $this->groupService->getGroupsIndex()
        ]);
    }

    public function create()
    {
        return inertia('Dashboard/Groups/Create', [
            'teachers' => $this->teacherService->getTeachers(),
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
