<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "admin",
                "email" => "admin@mailinator.com",
                "password" => Hash::make('admin'),
                'user_type' => 'admin',
            ], [
                "name" => "user 1",
                "email" => "user_1@mailinator.com",
                "password" => Hash::make('user_1'),
                'user_type' => 'user',
            ], [
                "name" => "user 2",
                "email" => "user_2@mailinator.com",
                "password" => Hash::make('user_2'),
                'user_type' => 'user',
            ]
        ];
        foreach($users as $user){
            User::create($user);
        }
    }
}
