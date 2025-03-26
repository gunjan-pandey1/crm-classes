<?php

namespace Database\Factories;

use App\Models\CrmUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrmUserFactory extends Factory
{
    protected $model = CrmUser::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('##########'),
            'password' => bcrypt('password'),
            'user_type' => 2,
            'status' => 0  // Changed to 'A' for Active
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return ['user_type' => 2];
        });
    }

    public function teacher()
    {
        return $this->state(function (array $attributes) {
            return ['user_type' => 3];
        });
    }

    public function staff()
    {
        return $this->state(function (array $attributes) {
            return ['user_type' => 4];
        });
    }
}
