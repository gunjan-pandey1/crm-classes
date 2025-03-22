<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Services\AuthorizationService;

class CrmUserPolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'users', 'view');
    }

    public function view(CrmUser $user, CrmUser $targetUser): bool
    {
        return $this->authService->canPerformAction($user, 'users', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'users', 'create');
    }

    public function update(CrmUser $user, CrmUser $targetUser): bool
    {
        return $this->authService->canPerformAction($user, 'users', 'edit');
    }

    public function delete(CrmUser $user, CrmUser $targetUser): bool
    {
        return $this->authService->canPerformAction($user, 'users', 'delete');
    }
}