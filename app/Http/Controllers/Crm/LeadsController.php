<?php

namespace App\Http\Controllers\Crm;

use Inertia\Inertia;
use Inertia\Response;
use App\Services\Crm\LeadsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\LeadsRequest;

class LeadsController extends Controller
{
    public function __construct(protected LeadsService $leadsService)
    {}

    public function leadsprocess(LeadsRequest $request): Response
    {
        $result = $this->leadsService->getAllLeads();
        return Inertia::render('crmPages/leads', [
            'leads' => $result
        ]);
    }
}