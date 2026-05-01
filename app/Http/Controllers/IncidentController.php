<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentUpdate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'priority' => 'required|in:Low,Med,High,Critical',
            'status' => 'required|in:Open,Ongoing,Closed',
            'reported_at' => 'required|date',
        ]);

        $incident = Incident::create($validated);

        // Log initial creation
        IncidentUpdate::create([
            'incident_id' => $incident->id,
            'user_id' => Auth::id(),
            'type' => 'status_change',
            'new_value' => $incident->status,
            'message' => 'Incident intelligence report filed.',
        ]);

        return redirect()->route('incidents.index')->with('success', 'Incident created successfully.');
    }

    public function show(Incident $incident)
    {
        $allMembers = \App\Models\TeamMember::all();
        $updates = $incident->updates()->with('user')->get();
        return view('incidents.show', compact('incident', 'allMembers', 'updates'));
    }

    public function edit(Incident $incident)
    {
        return view('incidents.edit', compact('incident'));
    }

    public function update(Request $request, Incident $incident)
    {
        $oldStatus = $incident->status;
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'priority' => 'required|in:Low,Med,High,Critical',
            'status' => 'required|in:Open,Ongoing,Closed',
            'reported_at' => 'required|date',
        ]);

        $incident->update($validated);

        if ($oldStatus != $incident->status) {
            IncidentUpdate::create([
                'incident_id' => $incident->id,
                'user_id' => Auth::id(),
                'type' => 'status_change',
                'old_value' => $oldStatus,
                'new_value' => $incident->status,
                'message' => "Operational status transitioned from $oldStatus to {$incident->status}.",
            ]);
        }

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
        
        IncidentUpdate::create([
            'incident_id' => $incident->id,
            'user_id' => Auth::id(),
            'type' => 'personnel_assigned',
            'message' => 'Response team deployment orders updated.',
        ]);

        return redirect()->route('incidents.show', $incident)->with('success', 'Team members updated for this incident.');
    }

    public function storeUpdate(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        IncidentUpdate::create([
            'incident_id' => $incident->id,
            'user_id' => Auth::id(),
            'type' => 'comment',
            'message' => $validated['message'],
        ]);

        return redirect()->route('incidents.show', $incident)->with('success', 'Operational note added.');
    }
}
