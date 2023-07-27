<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\GroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Groups/Index', [
            'groups' => Group::all()
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
