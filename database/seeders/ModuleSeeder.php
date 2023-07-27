<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                "name" => "Nivel 1",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 2",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 3",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 4",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 5",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 6",
                "course_id" => 1
            ],
            [
                "name" => "Nivel 7",
                "course_id" => 1
            ]
        ];

        foreach ($modules as $module) {
            \App\Models\Module::create($module);
        }
    }
}
