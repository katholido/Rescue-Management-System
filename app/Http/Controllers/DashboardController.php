<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIncidents = Incident::count();
        $activeIncidents = Incident::whereIn('status', ['Open', 'Ongoing'])->count();
        $availableMembers = TeamMember::where('availability_status', 'Available')->count();
        $totalMembers = TeamMember::count();
        
        $recentIncidents = Incident::latest()->take(5)->get();
        $recentMembers = TeamMember::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalIncidents', 
            'activeIncidents', 
            'availableMembers', 
            'totalMembers',
            'recentIncidents',
            'recentMembers'
        ));
    }
}
