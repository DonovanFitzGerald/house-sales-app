<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake();

        $counties = [
            'Antrim','Armagh','Carlow','Cavan','Clare','Cork','Derry','Donegal','Down','Dublin',
            'Fermanagh','Galway','Kerry','Kildare','Kilkenny','Laois','Leitrim','Limerick','Longford',
            'Louth','Mayo','Meath','Monaghan','Offaly','Roscommon','Sligo','Tipperary','Tyrone',
            'Waterford','Westmeath','Wexford','Wicklow'
        ];
        $energyRatings = ['A1','A2','A3','B1','B2','B3','C1','C2','C3','D1','D2','E1','E2','F','G'];
        $houseTypes = ['detatched','semi-detached','terraced','bungalow','apartment','studio'];

        $rows = [];
        for ($i = 0; $i < 100; $i++) {
            $rows[] = [
                'description'     => $faker->paragraphs(2, true),
                'address_line_1'  => $faker->buildingNumber() . ' ' . $faker->streetName(),
                'address_line_2'  => $faker->secondaryAddress(),
                'city'            => $faker->city(),
                'county'          => $faker->randomElement($counties),
                'zip'             => $faker->postcode(),
                'beds'            => $faker->numberBetween(1, 6),
                'baths'           => $faker->numberBetween(1, 4),
                'square_metres'   => $faker->numberBetween(35, 300),
                'energy_rating'   => $faker->randomElement($energyRatings),
                'house_type'      => $faker->randomElement($houseTypes),
                'featured_image'  => 'detached_' . $faker->numberBetween(1, 10) . '.jpg',
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        DB::table('houses')->insert($rows);
    }
}