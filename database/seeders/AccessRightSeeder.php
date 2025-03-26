<?php

namespace Database\Seeders;

use App\Models\AccessRight;
use App\Models\CrmUser;
use Illuminate\Database\Seeder;

class AccessRightSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records
        AccessRight::truncate();

        // Get all users
        $users = CrmUser::all();

        $modules = ['dashboard', 'leads', 'quotes', 'activities', 'organization', 'students', 'courses'];

        foreach ($users as $user) {
            foreach ($modules as $module) {
                AccessRight::create([
                    'user_id' => $user->id,
                    'module_name' => $module,
                    'can_view' => $user->user_type === 1 ? 1 : 0,
                    'can_create' => $user->user_type === 1 ? 1 : 0,
                    'can_edit' => $user->user_type === 1 ? 1 : 0,
                    'can_delete' => $user->user_type === 1 ? 1 : 0
                ]);
            }
        }
    }
}
