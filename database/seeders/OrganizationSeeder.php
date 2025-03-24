<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        // Create some predefined organizations
        $organizations = [
            [
                'name' => 'Shetty Classes Main Branch',
                'student_count' => 250
            ],
            [
                'name' => 'Shetty Classes North Campus',
                'student_count' => 180
            ],
            [
                'name' => 'Shetty Classes South Wing',
                'student_count' => 150
            ]
        ];

        foreach ($organizations as $org) {
            Organization::create($org);
        }

        // Create additional random organizations
        Organization::factory()
            ->count(7)
            ->create();
    }
}
