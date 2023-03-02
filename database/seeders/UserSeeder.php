<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PDO;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make('12345'),
                "role" => 'admin'
            ],
            [
                "name" => "user",
                "email" => "user@gmail.com",
                "password" => Hash::make('12345')
            ],
        ];
        foreach ($user as $user) {
            User::create($user);
        }
    }
}
