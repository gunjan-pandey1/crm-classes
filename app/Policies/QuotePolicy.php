<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Models\Quote;
use App\Services\Auth\AuthorizationService;

class QuotePolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {   
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'quotes', 'view');
    }

    public function view(CrmUser $user, Quote $quote): bool
    {
        return $this->authService->canPerformAction($user, 'quotes', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'quotes', 'create');
    }

    public function update(CrmUser $user, Quote $quote): bool
    {
        return $this->authService->canPerformAction($user, 'quotes', 'edit');
    }

    public function delete(CrmUser $user, Quote $quote): bool
    {
        return $this->authService->canPerformAction($user, 'quotes', 'delete');
    }
}