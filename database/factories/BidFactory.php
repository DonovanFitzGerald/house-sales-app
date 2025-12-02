<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'house_id' => House::factory(),
            'value' => fake()->numberBetween(100000, 1000000),
        ];
    }

    /**
     * Create a bid for a specific house with a value based on bedroom count.
     */
    public function forHouse(House $house, int $bidNumber = 1): static
    {
        $baseBid = $house->beds * fake()->numberBetween(100000, 150000);
        // Each bid increases the value by 5-20%
        $multiplier = pow(fake()->numberBetween(105, 120) / 100, $bidNumber);

        return $this->state(fn () => [
            'house_id' => $house->id,
            'value' => (int) ($baseBid * $multiplier),
        ]);
    }
}