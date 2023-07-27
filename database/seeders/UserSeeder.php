<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Kenet Picado",
                "email" => "kenetpicado1@gmail.com",
                "password" => Hash::make("password")
            ],
            [
                "name" => "Jairo Paniagua",
                "email" => "jeypaniagua@gmail.com",
                "password" => Hash::make("password")
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
