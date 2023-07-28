<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CourseRequest;
use App\Models\Course;
use App\Models\Module;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        private readonly CourseService $courseService
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/Courses/Index', [
            'courses' => $this->courseService->getWithModulesCount()
        ]);
    }

    public function show($course)
    {
        return inertia('Dashboard/Courses/Show', [
            'course' => $this->courseService->findWithModules($course)
        ]);
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());

        return back();
    }

    public function update(CourseRequest $request, $course)
    {
        Course::where('id', $course)->update($request->validated());

        return back();
    }
}
