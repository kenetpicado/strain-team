<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Module;

class CourseService
{
    public function getWithModulesCount()
    {
        return Course::query()
            ->addSelect([
                'modules_count' => Module::query()
                    ->selectRaw('count(*)')
                    ->whereColumn('course_id', 'courses.id')
            ])
            ->get(['id', 'name', 'is_active']);
    }

    public function findWithModules($course_id)
    {
    	return Course::query()
            ->with('modules:id,name,course_id')
            ->find($course_id, ['id', 'name', 'is_active']);
    }
}
