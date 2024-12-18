<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // Show a list of the coach's teams
    public function index()
    {
        $teams = Team::where('user_id', Auth::id())->get(); // Fetch teams owned by the authenticated coach

        return view('teams.index', compact('teams'));
    }

    // Show the form to create a new team
    public function create()
    {
        return view('teams.create');
    }

    // Store a new team
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Create the team and associate it with the authenticated user (coach)
        Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(), // Associate the team with the current coach
        ]);

        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
    }

    // Show the form to edit an existing team
    public function edit($id)
    {
        $team = Team::findOrFail($id);

        // Ensure the team belongs to the current coach
        if ($team->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teams.edit', compact('team'));
    }

    // Update an existing team
    public function update(Request $request, $id)
{
    $team = Team::findOrFail($id);

    // Ensure the team belongs to the current coach
    if ($team->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
    ]);

    $team->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->back()->with('success', 'Team updated successfully!');
}

    // Delete a team
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        // Ensure the team belongs to the current coach
        if ($team->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
