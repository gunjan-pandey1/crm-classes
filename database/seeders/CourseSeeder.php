<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some predefined courses
        $courses = [
            [
                'sku' => 'CRS-JEE1',
                'course_name' => 'JEE Mathematics',
                'rate' => 25000,
                'total_seats' => 50,
                'allotted_seats' => 0,
                'available_seats' => 50
            ],
            [
                'sku' => 'CRS-NEET1',
                'course_name' => 'NEET Biology',
                'rate' => 30000,
                'total_seats' => 60,
                'allotted_seats' => 0,
                'available_seats' => 60
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Create additional random courses
        Course::factory()
            ->count(8)
            ->create();
    }
}
