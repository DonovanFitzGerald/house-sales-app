<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
                [
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                ],
                [
                    'name' => 'Donovan',
                    'email' => 'donovan.fitzg@gmail.com',
                    'password' => Hash::make('12345678'),
                    'role' => 'user',
                ]
            ];

        User::insert($users);
    }
}