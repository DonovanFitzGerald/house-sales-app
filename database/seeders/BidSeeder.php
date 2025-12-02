<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('role', 'user')->pluck('id');
        $houses = House::all();

        foreach ($houses as $house) {
            $bidCount = fake()->numberBetween(1, 20);
            $baseBid = $house->beds * fake()->numberBetween(100000, 150000);
            $currentBid = $baseBid;

            // Create escalating bids for each house
            for ($i = 0; $i < $bidCount; $i++) {
                $currentBid = round($currentBid * (fake()->numberBetween(105, 120) / 100));

                Bid::factory()->create([
                    'user_id' => $userIds->random(),
                    'house_id' => $house->id,
                    'value' => $currentBid,
                ]);
            }
        }
    }
}
