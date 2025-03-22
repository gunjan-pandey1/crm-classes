<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\CrmUser;
use App\Models\Lead;
use App\Models\Quote;
use App\Models\Activity;
use App\Models\Course;
use App\Models\Student;
use App\Policies\CrmUserPolicy;
use App\Policies\LeadPolicy;
use App\Policies\QuotePolicy;
use App\Policies\ActivityPolicy;
use App\Policies\CoursePolicy;
use App\Policies\StudentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CrmUser::class => CrmUserPolicy::class,
        Lead::class => LeadPolicy::class,
        Quote::class => QuotePolicy::class,
        Activity::class => ActivityPolicy::class,
        Course::class => CoursePolicy::class,
        Student::class => StudentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for full access rights
        Gate::define('full-access', function (CrmUser $user, string $module) {
            $fullAccessRights = $user->fullAccessRights;
            return $fullAccessRights && $fullAccessRights->$module > 0;
        });

        // Define gates for module-specific access rights
        Gate::define('module-access', function (CrmUser $user, string $module, string $permission) {
            $accessRight = $user->accessRights()
                ->where('module_name', $module)
                ->first();

            if (!$accessRight) {
                return false;
            }

            $permissionField = 'can_' . $permission;
            return $accessRight->$permissionField > 0;
        });
    }
}