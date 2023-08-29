<?php

namespace App\Services;

use App\Models\Group;

class GroupService
{
    public function getGroupsIndex()
    {
        return Group::query()
            ->withCourse()
            ->withTeacher()
            ->with('branch:id,name')
            ->when(auth()->user()->branch_id, fn ($query) => $query->where('branch_id', auth()->user()->branch_id))
            ->paginate();
    }
}
