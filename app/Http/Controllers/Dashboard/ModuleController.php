<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ModuleRequest;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(ModuleRequest $request)
    {
        Module::create($request->validated());

        return back();
    }

    public function update(ModuleRequest $request, $module)
    {
        Module::where('id', $module)->update($request->validated());

        return back();
    }
}
