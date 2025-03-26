<?php

namespace Database\Seeders;

use App\Models\CrmUser;
use App\Models\Lead;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        // Get all CRM users
        $users = CrmUser::all();
        
        // Create leads distributed among users
        foreach ($users as $user) {
            $leadCount = $user->user_type === 1 ? 5 : 3; // More leads for admin
            
            Lead::factory()->count($leadCount)->create([
                'user_id' => $user->id
            ]);
        }
        
        // Create some hot leads in negotiation stage
        Lead::factory()->count(5)->create([
            'user_id' => $users->random()->id,
            'lead_type' => 'hot', // ✅ Use a valid value
            'stage' => 'negotiation',
            'lead_value' => fake()->randomFloat(2, 10000, 100000),
            'rotten_lead' => 'no'
        ]);
        
        // Create some closed deals
        Lead::factory()->count(3)->create([
            'user_id' => $users->random()->id,
            'stage' => 'closed_won',
            'lead_type' => 'hot', // ✅ Use a valid value
            'lead_value' => fake()->randomFloat(2, 5000, 50000),
            'rotten_lead' => 'no'
        ]);        
    }
}
