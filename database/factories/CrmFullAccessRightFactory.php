<?php

namespace Database\Factories;

use App\Models\CrmFullAccessRight;
use App\Models\CrmUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrmFullAccessRightFactory extends Factory
{
    protected $model = CrmFullAccessRight::class;

    public function definition(): array
    {
        return [
            'user_id' => CrmUser::factory(),
            'leads' => $this->faker->randomElement([0, 1]),
            'quotes' => $this->faker->randomElement([0, 1]),
            'activities' => $this->faker->randomElement([0, 1]),
            'organization' => $this->faker->randomElement([0, 1]),
            'students' => $this->faker->randomElement([0, 1]),
            'courses' => $this->faker->randomElement([0, 1])
        ];
    }

    public function fullAccess()
    {
        return $this->state(function (array $attributes) {
            return [
                'leads' => 1,
                'quotes' => 1,
                'activities' => 1,
                'organization' => 1,
                'students' => 1,
                'courses' => 1
            ];
        });
    }

    public function noAccess()
    {
        return $this->state(function (array $attributes) {
            return [
                'leads' => 0,
                'quotes' => 0,
                'activities' => 0,
                'organization' => 0,
                'students' => 0,
                'courses' => 0
            ];
        });
    }
}