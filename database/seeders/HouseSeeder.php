<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $realtorIds = User::where('role', 'realtor')->pluck('id');

        House::factory()
            ->count(300)
            ->create()
            ->each(function (House $house) use ($realtorIds) {
                // Assign 1-5 random realtors to each house
                $randomRealtorIds = $realtorIds->shuffle()->take(fake()->numberBetween(1, 5));
                $house->realtors()->attach($randomRealtorIds);
            });
    }
}
