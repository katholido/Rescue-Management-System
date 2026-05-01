<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = TeamMember::latest()->paginate(10);
        return view('team_members.index', compact('members'));
    }

    public function create()
    {
        return view('team_members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'availability_status' => 'required|in:Available,On Mission,Off Duty',
        ]);

        TeamMember::create($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member added successfully.');
    }

    public function show(TeamMember $teamMember)
    {
        return view('team_members.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        return view('team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'availability_status' => 'required|in:Available,On Mission,Off Duty',
        ]);

        $teamMember->update($validated);

        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team member removed successfully.');
    }
}
