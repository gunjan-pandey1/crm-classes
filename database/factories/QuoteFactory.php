<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subject' => fake()->sentence(),
            'subtotal' => fake()->randomFloat(2, 500, 5000),
            'discount' => fake()->randomFloat(2, 0, 200),
            'tax' => fake()->randomFloat(2, 50, 500),
            'adjustment' => fake()->randomFloat(2, -100, 100),
            'grand_total' => fake()->randomFloat(2, 1000, 10000),
            'expired_at' => fake()->dateTimeBetween('now', '+30 days'),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
