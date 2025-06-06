<?php

namespace Database\Factories;

use App\Models\Vehicles;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vehicles::class;

    public function definition(): array
    {
        return [
            'vehicle' => $this->faker->word(),
            'brand' => $this->faker->randomElement(
                ['Toyota', 'Ford', 'Chevrolet', 'Volkswagen', 'Honda']
            ),
            'year' => $this->faker->numberBetween(2000, 2025),
            'sold' => $this->faker->boolean(),
        ];
    }
}
