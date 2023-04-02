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
        $user = User::create([
            "name" => "Marwan",
            "email" => "marwan@gmail.com",
            "username" => "marwan",
            "phone" => "089529909036",
            'password' => bcrypt('marwan'),
        ]);
    }
}
