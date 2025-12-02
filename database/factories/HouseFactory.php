<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    protected static array $counties = [
        'Antrim', 'Armagh', 'Carlow', 'Cavan', 'Clare', 'Cork', 'Derry', 'Donegal', 'Down', 'Dublin',
        'Fermanagh', 'Galway', 'Kerry', 'Kildare', 'Kilkenny', 'Laois', 'Leitrim', 'Limerick', 'Longford',
        'Louth', 'Mayo', 'Meath', 'Monaghan', 'Offaly', 'Roscommon', 'Sligo', 'Tipperary', 'Tyrone',
        'Waterford', 'Westmeath', 'Wexford', 'Wicklow',
    ];

    protected static array $energyRatings = [
        'A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'C3', 'D1', 'D2', 'E1', 'E2', 'F', 'G',
    ];

    protected static array $houseTypes = [
        'detached', 'semi-detached', 'terraced', 'bungalow', 'apartment',
    ];

    public function definition(): array
    {
        $beds = fake()->numberBetween(1, 6);
        $baths = (int) floor($beds / 2);
        $squareMetres = $beds * fake()->numberBetween(30, 80);
        $houseType = fake()->randomElement(static::$houseTypes);

        return [
            'description' => fake()->paragraphs(2, true),
            'address_line_1' => fake()->buildingNumber().' '.fake()->streetName(),
            'address_line_2' => fake()->secondaryAddress(),
            'city' => fake()->city(),
            'county' => fake()->randomElement(static::$counties),
            'zip' => fake()->postcode(),
            'beds' => $beds,
            'baths' => $baths,
            'square_metres' => $squareMetres,
            'energy_rating' => fake()->randomElement(static::$energyRatings),
            'house_type' => $houseType,
            'featured_image' => $houseType.'_'.fake()->numberBetween(1, 5).'.jpg',
        ];
    }
}
