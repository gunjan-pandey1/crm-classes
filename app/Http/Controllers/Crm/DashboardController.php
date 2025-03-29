<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\Crm\MenuAccessService;

class DashboardController extends Controller
{
    public function menuAccessController()
    {
        $menuAccess = app(MenuAccessService::class)->getMenuList();
        return view('crm.dashboard', compact('menuAccess'));
    }
}
