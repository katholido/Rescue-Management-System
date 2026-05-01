<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Incident::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $incidents = $query->latest()->paginate(10)->withQueryString();
        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'priority' => 'required|in:Low,Med,High',
            'status' => 'required|in:Open,Ongoing,Closed',
            'reported_at' => 'required|date',
        ]);

        Incident::create($validated);

        return redirect()->route('incidents.index')->with('success', 'Incident created successfully.');
    }

    public function show(Incident $incident)
    {
        $allMembers = \App\Models\TeamMember::all();
        return view('incidents.show', compact('incident', 'allMembers'));
    }

    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
    }

    public function update(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'priority' => 'required|in:Low,Med,High',
            'status' => 'required|in:Open,Ongoing,Closed',
            'reported_at' => 'required|date',
        ]);

        $incident->update($validated);

        return redirect()->route('incidents.index')->with('success', 'Incident updated successfully.');
    }

    public function destroy(Incident $incident)
    {
        $incident->delete();

        return redirect()->route('incidents.index')->with('success', 'Incident deleted successfully.');
    }

    public function assignMembers(Request $request, Incident $incident)
    {
        $incident->teamMembers()->sync($request->members);
        return redirect()->route('incidents.show', $incident)->with('success', 'Team members updated for this incident.');
    }
}
