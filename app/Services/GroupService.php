<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;

class GroupService
{
    public function getGroupsIndex()
    {
        return Group::query()
            ->addSelect([
                "course" => Course::select('name')->whereColumn('course_id', 'courses.id')->limit(1),
                "teacher" => Teacher::select('name')->whereColumn('teacher_id', 'teachers.id')->limit(1)
            ])
            ->with('branch:id,name')
            ->when(auth()->user()->branch_id, fn ($query) => $query->where('branch_id', auth()->user()->branch_id))
            ->get();
    }
}
