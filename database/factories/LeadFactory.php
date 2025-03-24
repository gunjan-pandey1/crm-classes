<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stages = ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'closed_won', 'closed_lost'];
        $sources = ['website', 'referral', 'social_media', 'direct', 'campaign'];
        $leadTypes = ['hot', 'warm', 'cold'];
        $rottenStates = ['yes', 'no'];
        
        return [
            'user_id' => \App\Models\CrmUser::factory(),
            'subject' => fake()->sentence(),
            'source' => fake()->randomElement($sources),
            'lead_value' => fake()->randomFloat(2, 1000, 50000),
            'lead_type' => fake()->randomElement($leadTypes),
            'tag_name' => fake()->word(),
            'contact_student' => fake()->name(),
            'stage' => fake()->randomElement($stages),
            'rotten_lead' => fake()->randomElement($rottenStates),
            'expected_close_date' => fake()->dateTimeBetween('now', '+6 months')
        ];
    }
}
