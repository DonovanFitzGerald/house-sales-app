<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseRealtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        $realtors = User::where('role', 'realtor')->get();
        $houses = House::all();

        $rows = [];

        foreach ($houses as $house) {
            for ($i = 0; $i <= $faker->numberBetween(1, 3); $i++) {
                $rows[] = [
                    'user_id' => $faker->randomElement($realtors)->id,
                    'house_id' => $house->id,
                ];
            }
        }

        DB::table('house_realtor')->insertOrIgnore($rows);
    }
}
