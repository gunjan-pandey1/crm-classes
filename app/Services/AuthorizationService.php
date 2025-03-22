<?php

namespace App\Services;

use App\Models\CrmUser;
use App\Models\AccessRight;
use App\Models\FullAccessRight;

class AuthorizationService
{
    public function hasFullAccess(CrmUser $user, string $module): bool
    {
        $fullAccessRights = $user->fullAccessRights;
        return $fullAccessRights && $fullAccessRights->$module > 0;
    }

    public function hasModuleAccess(CrmUser $user, string $module, string $permission): bool
    {
        $accessRight = $user->accessRights()
            ->where('module_name', $module)
            ->first();

        if (!$accessRight) {
            return false;
        }

        $permissionField = 'can_' . $permission;
        return $accessRight->$permissionField > 0;
    }

    public function canPerformAction(CrmUser $user, string $module, string $action): bool
    {
        // First check if user has full access
        if ($this->hasFullAccess($user, $module)) {
            return true;
        }

        // Then check specific module permissions
        return $this->hasModuleAccess($user, $module, $action);
    }
}