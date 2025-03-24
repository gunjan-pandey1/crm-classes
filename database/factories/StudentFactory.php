<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Quote;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        static $emailIncrement = 1;
        static $phoneIncrement = 1;
        
        return [
            'quotes_id' => Quote::factory(),
            'organization_id' => Organization::factory(),
            'courses_id' => Course::factory(),
            'name' => fake()->name(),
            'email' => sprintf('student%04d@example.com', $emailIncrement++),
            'contact_number' => sprintf('98%08d', $phoneIncrement++),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
