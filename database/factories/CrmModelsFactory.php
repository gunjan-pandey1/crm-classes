<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CrmModels>
 */
class CrmModelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'model_name' => $this->faker->unique()->word(),
            // 'model_slug' => $this->faker->unique()->word(),
            // 'model_icon' => $this->faker->unique()->word(),
            // 'status' => 1,
        ];
    }
}
