<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Userseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Admin",
            'email' => "Admin@gmail.com",
            'role' => "admin",
            'password' => Hash::make("test")
        ]);
        User::create([
            'name' => "ps",
            'email' => "ps@gmail.com",
            'role' => "ps",
            'password' => Hash::make("test")
        ]);
    }
}
