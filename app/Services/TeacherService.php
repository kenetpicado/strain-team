<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Teacher;

class TeacherService
{
    public function getIndex()
    {
        return Teacher::query()
            ->addSelect([
                'branch' => Branch::select('name')
                    ->whereColumn('branch_id', 'branches.id')
                    ->limit(1)
            ])
            ->paginate();
    }

    public function getToCreateGroup()
    {
        return Teacher::query()
            ->when(auth()->user()->branch_id, fn ($query) => $query->where('branch_id', auth()->user()->branch_id))
            ->get(['id', 'name', 'branch_id']);
    }
}
