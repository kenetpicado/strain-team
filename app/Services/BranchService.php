<?php

namespace App\Services;

use App\Models\Branch;

class BranchService
{
    public function getCurrents()
    {
        return auth()->user()->branch_id ?? Branch::all(['id', 'name']);
    }
}
