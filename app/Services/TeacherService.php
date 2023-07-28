<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherService
{
    public function getTeachers()
    {
        return Teacher::query()
            ->when(auth()->user()->branch_id, fn ($query) => $query->where('branch_id', auth()->user()->branch_id))
            ->get(['id', 'name', 'branch_id']);
    }
}
