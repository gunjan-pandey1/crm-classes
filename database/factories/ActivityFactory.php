<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\CrmUser::factory(),
            'title' => fake()->sentence(),
            'is_done' => fake()->randomElement([0, 1]),
            'comment' => fake()->paragraph(),
            'lead' => fake()->word(),
            'type' => fake()->randomElement(['call', 'meeting', 'email', 'task', 'note']),
            'schedule_from' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'schedule_to' => fake()->dateTimeBetween('now', '+2 months'),
            'created_at' => now()
        ];
    }
}
