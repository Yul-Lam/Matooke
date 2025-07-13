<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HarvestBatch>
 */
class HarvestBatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
public function definition(): array
{
    return [
        'farm_id' => \App\Models\Farm::inRandomOrder()->first()?->id ?? 1,
        'coffee_grade_id' => \App\Models\CoffeeGrade::inRandomOrder()->first()?->id ?? 1,
        'harvest_date' => $this->faker->date(),
        'quantity_kg' => $this->faker->numberBetween(50, 500),
        'status' => $this->faker->randomElement(['in_storage', 'shipped']),
        'processing_method' => $this->faker->randomElement(['washed', 'natural', 'honey']),
    ];
}
}
