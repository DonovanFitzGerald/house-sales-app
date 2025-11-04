<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rows = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'featured_image' => 'placeholder.jpg',
            ],
            [
                'name' => 'Donovan',
                'email' => 'donovan.fitzg@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'featured_image' => 'placeholder.jpg',
            ],
            [
                'name' => 'Donovan Realtor',
                'email' => 'donovan.fitzg@realtor.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'featured_image' => 'placeholder.jpg',
            ],
        ];

        $faker = fake();

        for ($i = 0; $i < 200; $i++) {
            $name = $faker->name();
            $email = $name.$faker->numberBetween(1, 1000).$faker->safeEmailDomain();

            $rows[] = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'user',
                'featured_image' => 'person_'.$faker->numberBetween(1, 10).'jpg',
            ];
        }

        for ($i = 0; $i < 50; $i++) {
            $name = $faker->name();
            $email = $name.$faker->numberBetween(1, 1000).$faker->safeEmailDomain();

            $rows[] = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'realtor',
                'featured_image' => 'person_'.$faker->numberBetween(1, 10).'jpg',
            ];
        }

        User::insert($rows);
    }
}