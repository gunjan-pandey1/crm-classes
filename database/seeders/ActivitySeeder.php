<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\CrmUser;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Get all users
        $users = CrmUser::all();
        
        foreach ($users as $user) {
            // Create completed activities
            Activity::factory()->count(3)->create([
                'user_id' => $user->id,
                'is_done' => 1,
                'schedule_from' => fake()->dateTimeBetween('-2 months', '-1 day'),
                'schedule_to' => fake()->dateTimeBetween('-1 day', 'now')
            ]);
            
            // Create pending activities
            Activity::factory()->count(2)->create([
                'user_id' => $user->id,
                'is_done' => 0,
                'schedule_from' => fake()->dateTimeBetween('now', '+1 month'),
                'schedule_to' => fake()->dateTimeBetween('+1 month', '+2 months')
            ]);
        }
    }
}
