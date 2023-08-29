<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\GroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __invoke(GroupRequest $request)
    {
        return response()->json([
            "data" => Group::query()
                ->where('is_active', 1)
                ->where("branch_id", $request->branch_id)
                ->select('id', 'info')
                ->addSelect([
                    "course" => Course::select('name')->whereColumn('course_id', 'courses.id')->limit(1),
                    "teacher" => Teacher::select('name')->whereColumn('teacher_id', 'teachers.id')->limit(1)
                ])
                ->get()
        ]);
    }
}
