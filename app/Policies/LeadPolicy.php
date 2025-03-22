<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Models\Lead;
use App\Services\AuthorizationService;

class LeadPolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {   
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'leads', 'view');
    }

    public function view(CrmUser $user, Lead $lead): bool
    {
        return $this->authService->canPerformAction($user, 'leads', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'leads', 'create');
    }

    public function update(CrmUser $user, Lead $lead): bool
    {
        return $this->authService->canPerformAction($user, 'leads', 'edit');
    }

    public function delete(CrmUser $user, Lead $lead): bool
    {
        return $this->authService->canPerformAction($user, 'leads', 'delete');
    }
}