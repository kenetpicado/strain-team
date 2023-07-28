<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TeacherRequest;
use App\Models\Branch;
use App\Models\Teacher;
use App\Notifications\RegisterNotification;
use App\Services\GeneralService;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct(
        private readonly GeneralService $generalService
    ) {
    }

    public function index()
    {
        $branches = auth()->user()->branch_id ?? Branch::all(['id', 'name']);

        return inertia('Dashboard/Teachers/Index', [
            'teachers' => Teacher::query()
                ->addSelect([
                    'branch' => Branch::select('name')
                        ->whereColumn('branch_id', 'branches.id')
                        ->limit(1)
                ])
                ->get(),
            'branches' => $branches
        ]);
    }

    public function store(TeacherRequest $request)
    {
        $this->generalService->storeModel(new Teacher(), $request->validated());

        return back();
    }

    public function update(TeacherRequest $request, $teacher)
    {
        Teacher::where('id', $teacher)->update($request->validated());

        return back();
    }
}
