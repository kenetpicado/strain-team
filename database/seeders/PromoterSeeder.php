<?php

namespace Database\Seeders;

use App\Models\Promoter;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $branch = rand(1, 2);
            $promoter = Promoter::create([
                "name" => 'Promotor: ' . $i,
                "email" => $i . "promotor@gmail.com",
                "password" => Hash::make("password"),
                "fee" => 20,
                "is_active" => true,
            ]);

            for ($j = 1; $j < 10; $j++) {
                $student = Student::create([
                    "branch_id" => $branch,
                    "promoter_id" => $promoter->id,
                    "name" => "Estudiante " . $i . $j,
                    "birth" => "2026-05-16",
                    "id_number" => $i . $j . "1-260598-1002H",
                    "phone" => "860068" . $i . $j,
                    "tutor" => "Tutor " . $i . $j,
                    "username" => "estudiante" . $i . $j,
                    "password" => Hash::make("password")
                ]);

                $student->groups()->attach(rand(1, 10));
            }
        }
    }
}
