<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function __construct(
        private readonly GroupService $groupService
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
        $teachers = auth()->user()->branch_id
            ? Teacher::where('branch_id', auth()->user()->branch_id)->get(['id', 'name', 'branch_id'])
            : Teacher::all(['id', 'name', 'branch_id']);

        return inertia('Dashboard/Groups/Create', [
            'teachers' => $teachers,
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
