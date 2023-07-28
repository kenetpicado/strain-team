<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = [
            ["name" => "LEON",],
            ["name" => "MANAGUA",],
        ];

        foreach ($branches as $value) {
            Branch::create($value);
        }
    }
}
