<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CourseRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Courses/Index', [
            'courses' => Course::query()
                ->addSelect([
                    'modules_count' => Module::query()
                        ->selectRaw('count(*)')
                        ->whereColumn('course_id', 'courses.id')
                ])
                ->get()
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
