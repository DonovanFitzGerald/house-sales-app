<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create fixed test accounts
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'donovan@admin.com',
            'role' => 'admin',
            'featured_image' => 'placeholder.jpg',
        ]);

        User::factory()->create([
            'name' => 'Donovan',
            'email' => 'donovan@user.com',
            'featured_image' => 'placeholder.jpg',
        ]);

        User::factory()->create([
            'name' => 'Donovan Realtor',
            'email' => 'donovan@realtor.com',
            'role' => 'realtor',
            'featured_image' => 'placeholder.jpg',
        ]);

        // Create random users and realtors
        User::factory()->count(200)->create();
        User::factory()->realtor()->count(50)->create();
    }
}
