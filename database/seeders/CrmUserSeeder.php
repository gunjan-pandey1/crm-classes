<?php

namespace Database\Seeders;

use App\Models\CrmUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');

        // Clear existing records
        CrmUser::truncate();

        // Create super admin
        CrmUser::create([
            'user_type' => 1,
            'name' => 'Super Admin',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'phone' => '9876543210',
            'password' => bcrypt('password'),
            'status' => 0
        ]);

        // Create admin
        CrmUser::create([
            'user_type' => 2,
            'name' => 'Admin User',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => bcrypt('password'),
            'status' => 0
        ]);

        // Create teachers with unique emails
        for ($i = 1; $i <= 5; $i++) {
            CrmUser::create([
                'user_type' => 3,
                'name' => fake()->name(),
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => "teacher{$i}@example.com",
                'phone' => fake()->numerify('##########'),
                'password' => bcrypt('password'),
                'status' => 0
            ]);
        }

        // Create staff members with unique emails
        for ($i = 1; $i <= 3; $i++) {
            CrmUser::create([
                'user_type' => 4,
                'name' => fake()->name(),
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => "staff{$i}@example.com",
                'phone' => fake()->numerify('##########'),
                'password' => bcrypt('password'),
                'status' => 0
            ]);
        }

        // Create regular users with unique emails
        for ($i = 1; $i <= 10; $i++) {
            CrmUser::create([
                'user_type' => 2,
                'name' => fake()->name(),
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => "user{$i}@example.com",
                'phone' => fake()->numerify('##########'),
                'password' => bcrypt('password'),
                'status' => 0
            ]);
        }

        // Enable foreign key checks
        DB::statement('PRAGMA foreign_keys = ON');
    }
}
