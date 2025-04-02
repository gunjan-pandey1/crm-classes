<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Models\Student;
use App\Services\Auth\AuthorizationService;

class StudentPolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {   
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'students', 'view');
    }

    public function view(CrmUser $user, Student $student): bool
    {
        return $this->authService->canPerformAction($user, 'students', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'students', 'create');
    }

    public function update(CrmUser $user, Student $student): bool
    {
        return $this->authService->canPerformAction($user, 'students', 'edit');
    }

    public function delete(CrmUser $user, Student $student): bool
    {
        return $this->authService->canPerformAction($user, 'students', 'delete');
    }
}