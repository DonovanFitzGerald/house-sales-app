<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        $users = User::where('role', 'user')->get();
        $houses = House::all();

        $rows = [];

        foreach ($houses as $house) {

            $topBid = $house->beds * $faker->numberBetween(100000, 150000);

            for ($i = 0; $i <= $faker->numberBetween(1, 20); $i++) {
                $topBid = $topBid * ($faker->numberBetween(105, 120) / 100);
                $rows[] = [
                    'user_id' => $faker->randomElement($users)->id,
                    'house_id' => $house->id,
                    'value' => $topBid,
                ];
            }
        }

        DB::table('bids')->insertOrIgnore($rows);
    }
}
