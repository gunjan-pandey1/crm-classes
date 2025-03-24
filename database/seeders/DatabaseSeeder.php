<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CrmUserSeeder::class,
            AccessRightSeeder::class,
            CrmFullAccessRightSeeder::class,
            LeadSeeder::class,
            QuoteSeeder::class,
            ActivitySeeder::class,
            OrganizationSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
