<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Models\Activity;
use App\Services\Auth\AuthorizationService;

class ActivityPolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {   
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'activities', 'view');
    }

    public function view(CrmUser $user, Activity $activity): bool
    {
        return $this->authService->canPerformAction($user, 'activities', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'activities', 'create');
    }

    public function update(CrmUser $user, Activity $activity): bool
    {
        return $this->authService->canPerformAction($user, 'activities', 'edit');
    }

    public function delete(CrmUser $user, Activity $activity): bool
    {
        return $this->authService->canPerformAction($user, 'activities', 'delete');
    }
}