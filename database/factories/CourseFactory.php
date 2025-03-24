<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        static $skuIncrement = 1;
        static $nameIncrement = 1;
        
        $courses = [
            'Mathematics', 'Physics', 'Chemistry', 'Biology', 
            'Computer Science', 'English', 'History', 'Geography', 
            'Economics', 'Business Studies'
        ];
        
        $totalSeats = fake()->numberBetween(30, 100);
        $allottedSeats = fake()->numberBetween(0, $totalSeats);
        
        return [
            'sku' => sprintf('CRS-%04d', $skuIncrement++),
            'course_name' => $courses[($nameIncrement++ - 1) % count($courses)] . ' ' . $skuIncrement,
            'rate' => fake()->numberBetween(5000, 50000),
            'total_seats' => $totalSeats,
            'allotted_seats' => $allottedSeats,
            'available_seats' => $totalSeats - $allottedSeats
        ];
    }
}