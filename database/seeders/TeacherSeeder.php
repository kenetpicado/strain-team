<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            $branch = rand(1,2);
            $teacher = Teacher::create([
                "name" => 'Profesor: ' . $i,
                "email" => $i . "profesor@gmail.com",
                "branch_id" => $branch,
                "is_active" => true,
                "password" => Hash::make("password")
            ]);

            Group::create([
                "course_id" => 1,
                "teacher_id" => $teacher->id,
                "branch_id" => $branch,
                "info" => "Grupo " . $i
            ]);
        }
    }
}
