<?php

namespace Database\Factories;

use App\Models\AccessRight;
use App\Models\CrmUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessRightFactory extends Factory
{
    protected $model = AccessRight::class;

    public function definition()
    {
        return [
            'user_id' => CrmUser::factory(),
            'module_name' => $this->faker->randomElement([
                'dashboard',
                'users',
                'students',
                'courses',
                'batches',
                'payments',
                'reports'
            ]),
            'can_view' => $this->faker->integer(),
            'can_create' => $this->faker->integer(),
            'can_edit' => $this->faker->integer(),
            'can_delete' => $this->faker->integer(),
        ];
    }
}
