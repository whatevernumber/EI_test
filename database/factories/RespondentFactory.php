<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Respondent>
 */
class RespondentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(18, 100),
            'city_id' => fake()->numberBetween(1, 4),
            'ei' => fake()->numberBetween(1, 200),
            'sex' => fake()->randomElement(['f', 'm']),
        ];
    }
}
