<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function menuAccess()
    {
        return [
            'dashboard' => [
                'access' => auth()->user()->can('view dashboard'),
                'icon' => 'LayoutGrid',
                'title' => 'Dashboard',
                'url' => route('dashboard'),
            ],
            'leads' => [
                'access' => auth()->user()->can('view leads'),
                'icon' => 'Headset',
                'title' => 'Leads',
                'url' => route('leads.index'),
            ],
            'quotes' => [
                'access' => auth()->user()->can('view quotes'),
                'icon' => 'Quote',
                'title' => 'Quotes',
                'url' => route('quotes.index'),
            ],
            'activities' => [
                'access' => auth()->user()->can('view activities'),
                'icon' => 'SquareActivity',
                'title' => 'Activities',
                'url' => route('activities.index'),
            ],
            'contacts' => [
                'access' => auth()->user()->can('view contacts'),
                'icon' => 'Contact',
                'title' => 'Contacts',
                'url' => route('contacts.index'),
            ],
            'courses' => [
                'access' => auth()->user()->can('view courses'),
                'icon' => 'Book',
                'title' => 'Courses',
                'url' => route('courses.index'),
            ],
            'settings' => [
                'access' => auth()->user()->can('view settings'),
                'icon' => 'Settings',
                'title' => 'Settings',
                'url' => route('settings.index'),
            ],
        ];
    }

    public function dashboardDetails()
    {
        return [
            'totalLeads' => \App\Models\CrmLead::count(),
            'totalQuotes' => \App\Models\CrmQuote::count(),
            'totalActivities' => \App\Models\CrmActivity::count(),
            'totalContacts' => \App\Models\CrmContact::count(),
            'totalCourses' => \App\Models\CrmCourse::count(),
        ];
    }
}
