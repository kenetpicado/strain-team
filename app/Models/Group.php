<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'info',
        'course_id',
        'teacher_id',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function scopeWithCourse($query)
    {
        return $query->addSelect([
            "course" => Course::select('name')->whereColumn('course_id', 'courses.id')->limit(1),
        ]);
    }

    public function scopeWithTeacher($query)
    {
        return $query->addSelect([
            "teacher" => Teacher::select('name')->whereColumn('teacher_id', 'teachers.id')->limit(1)
        ]);
    }
}
