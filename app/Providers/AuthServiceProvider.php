<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
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

        Gate::define('full-access', function (CrmUser $user, string $module) {
            // Fetch the user's full access rights (hasOne relationship)
            $fullAccessRight = $user->fullAccessRights;
        
            // Log if no record exists
            if (!$fullAccessRight) {
                Log::info('No full access rights record found', ['user_id' => $user->id]);
                return false;
            }
        
            // Convert module name to lowercase to match DB columns
            $moduleColumn = strtolower($module);
        
            // Check if the column exists and has value > 0
            $hasAccess = isset($fullAccessRight->$moduleColumn) && $fullAccessRight->$moduleColumn > 0;
        
            // Log the result
            Log::info('Full access check', [
                'module' => $module,
                'column' => $moduleColumn,
                'value' => $fullAccessRight->$moduleColumn ?? 0
            ]);
        
            return $hasAccess;
        });

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