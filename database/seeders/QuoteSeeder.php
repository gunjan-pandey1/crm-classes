<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        // Get leads that are in proposal or negotiation stage
        $leads = Lead::whereIn('stage', ['P', 'N', 'W'])->get();
        
        // Create quotes for these leads
        foreach ($leads as $lead) {
            $quoteCount = $lead->stage === 'W' ? 1 : rand(1, 2);
            
            Quote::factory()->count($quoteCount)->create([
                'grand_total' => $lead->lead_value
            ]);
        }
    }
}
