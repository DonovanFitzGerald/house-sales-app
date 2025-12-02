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

        $faker = fake();

        $rows = [
            [
                'name' => 'Admin',
                'email' => 'donovan@admin.com',
                'phone_number' => $faker->phoneNumber(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'featured_image' => 'placeholder.jpg',
            ],
            [
                'name' => 'Donovan',
                'phone_number' => $faker->phoneNumber(),
                'email' => 'donovan@user.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'featured_image' => 'placeholder.jpg',
            ],
            [
                'name' => 'Donovan Realtor',
                'phone_number' => $faker->phoneNumber(),
                'email' => 'donovan@realtor.com',
                'password' => Hash::make('password'),
                'role' => 'realtor',
                'featured_image' => 'placeholder.jpg',
            ],
        ];

        for ($i = 0; $i < 200; $i++) {
            $name = $faker->name();
            $email = strtolower(preg_replace('/\s|\'/', '', $name.$faker->numberBetween(1, 1000).'@'.$faker->freeEmailDomain()));

            $rows[] = [
                'name' => $name,
                'email' => $email,
                'phone_number' => $faker->phoneNumber(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'featured_image' => 'person_'.$faker->numberBetween(1, 10).'.jpg',
            ];
        }

        for ($i = 0; $i < 50; $i++) {
            $name = $faker->name();
            $email = strtolower(preg_replace('/\s|\'/', '', $name.$faker->numberBetween(1, 1000).'@'.$faker->freeEmailDomain()));

            $rows[] = [
                'name' => $name,
                'email' => $email,
                'phone_number' => $faker->phoneNumber(),
                'password' => Hash::make('password'),
                'role' => 'realtor',
                'featured_image' => 'person_'.$faker->numberBetween(1, 10).'.jpg',
            ];
        }

        User::insert($rows);
    }
}
