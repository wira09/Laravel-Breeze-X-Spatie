<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default users with roles
        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("password"),
        ]);
        $admin->assignRole("admin");

        $penulis = User::create([
            "name" => "Penulis",
            "email" => "penulis@gmail.com",
            "password" => bcrypt("password"),
        ]);
        $penulis->assignRole("penulis");
    }
}
