<?php

namespace App\Services\Crm;

use Carbon\Carbon;
use App\Models\Lead;
use App\Constants\CommonConstant;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class LeadsService
{
    public function __construct(protected Lead $lead)
    {}

    public function getAllLeads(): array
    {
        try {
            $leads = $this->lead->all();
            
            if ($leads->isEmpty()) {
                return [
                    'status' => 'success',
                    'message' => 'No leads found',
                    'data' => []
                ];
            }
            return [
                'status' => 'success',
                'message' => 'Leads retrieved successfully',
                'data' => $leads
            ];

        } catch (\Exception $e) {
            return [
                'status' => CommonConstant::ERROR,
                'message' => 'Failed to retrieve leads',
                'data' => []
            ];
        }
    }
}