<?php

namespace Database\Seeders;

use App\Models\CrmFullAccessRight;
use App\Models\CrmUser;
use Illuminate\Database\Seeder;

class CrmFullAccessRightSeeder extends Seeder
{
    public function run(): void
    {
        // Give full access to super admin and admin users
        CrmUser::where('user_type', 1)->get()->each(function ($user) {
            CrmFullAccessRight::factory()
                ->fullAccess()
                ->create([
                    'user_id' => $user->id
                ]);
        });

        // Give specific access to teachers
        CrmUser::where('user_type', 3)->get()->each(function ($user) {
            CrmFullAccessRight::factory()->create([
                'user_id' => $user->id,
                'students' => 1,
                'courses' => 1,
                'activities' => 1
            ]);
        });

        // Give limited access to staff
        CrmUser::where('user_type', 4)->get()->each(function ($user) {
            CrmFullAccessRight::factory()->create([
                'user_id' => $user->id,
                'students' => 1,
                'activities' => 1
            ]);
        });

        // No access for regular users
        CrmUser::where('user_type', 5)->get()->each(function ($user) {
            CrmFullAccessRight::factory()
                ->noAccess()
                ->create([
                    'user_id' => $user->id
                ]);
        });
    }
}