<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        // Set up arrays for random data
        $counties = [
            'Antrim', 'Armagh', 'Carlow', 'Cavan', 'Clare', 'Cork', 'Derry', 'Donegal', 'Down', 'Dublin',
            'Fermanagh', 'Galway', 'Kerry', 'Kildare', 'Kilkenny', 'Laois', 'Leitrim', 'Limerick', 'Longford',
            'Louth', 'Mayo', 'Meath', 'Monaghan', 'Offaly', 'Roscommon', 'Sligo', 'Tipperary', 'Tyrone',
            'Waterford', 'Westmeath', 'Wexford', 'Wicklow',
        ];
        $energyRatings = ['A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3', 'D1', 'D2', 'E1', 'E2', 'F', 'G'];
        $houseTypes = ['detached', 'semi-detached', 'terraced', 'bungalow', 'apartment'];

        for ($i = 0; $i < 300; $i++) {
            $beds = $faker->numberBetween(1, 6);
            $baths = floor($beds / 2);
            $square_metres = $beds * $faker->numberBetween(30, 80);

            $house = [
                'description' => $faker->paragraphs(2, true),
                'address_line_1' => $faker->buildingNumber().' '.$faker->streetName(),
                'address_line_2' => $faker->secondaryAddress(),
                'city' => $faker->city(),
                'county' => $faker->randomElement($counties),
                'zip' => $faker->postcode(),
                'beds' => $beds,
                'baths' => $baths,
                'square_metres' => $square_metres,
                'energy_rating' => $faker->randomElement($energyRatings),
                'house_type' => $faker->randomElement($houseTypes),
                'featured_image' => $faker->randomElement($houseTypes).'_'.$faker->numberBetween(1, 5).'.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $house = House::create($house);

            $houseRealtors = User::inRandomOrder()->where('role', 'realtor')->take($faker->numberBetween(1,5))->pluck('id');

            $house->realtors()->attach($houseRealtors);
        }

    }
}