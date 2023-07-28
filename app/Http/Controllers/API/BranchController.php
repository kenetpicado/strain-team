<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'data' => Branch::all(['id', 'name']),
        ]);
    }
}
