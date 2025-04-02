<?php

namespace App\Policies;

use App\Models\CrmUser;
use App\Models\Course;
use App\Services\Auth\AuthorizationService;

class CoursePolicy
{
    protected AuthorizationService $authService;

    public function __construct(AuthorizationService $authService)
    {   
        $this->authService = $authService;
    }

    public function viewAny(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'courses', 'view');
    }

    public function view(CrmUser $user, Course $course): bool
    {
        return $this->authService->canPerformAction($user, 'courses', 'view');
    }

    public function create(CrmUser $user): bool
    {
        return $this->authService->canPerformAction($user, 'courses', 'create');
    }

    public function update(CrmUser $user, Course $course): bool
    {
        return $this->authService->canPerformAction($user, 'courses', 'edit');
    }

    public function delete(CrmUser $user, Course $course): bool
    {
        return $this->authService->canPerformAction($user, 'courses', 'delete');
    }
}