<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Create some students for each organization
        Organization::all()->each(function ($organization) {
            // Create students
            Student::factory()
                ->count(20)
                ->create([
                    'organization_id' => $organization->id,
                    'updated_at' => now()
                ]);
        });

        // Create some special case students
        Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'contact_number' => '9876543210',
            'organization_id' => Organization::first()->id,
            'updated_at' => now()
        ]);

        Student::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'contact_number' => '9876543211',
            'organization_id' => Organization::first()->id
        ]);
    }
}


