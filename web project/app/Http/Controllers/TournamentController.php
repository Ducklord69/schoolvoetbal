<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Matches;

class TournamentController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        $tournaments = Tournament::where('user_id', $user->id)
            ->where('status', 'Not_started')
            ->get();
    } elseif ($user->role === 'coach') {
        $tournaments = Tournament::where('status', 'Not_started')->get();
    } else {
        $tournaments = collect();
    }

    return view('tournaments', compact('tournaments'));
}

public function signup(Tournament $tournament)
{
    $team = Team::where('user_id', Auth::id())->first();

    if ($tournament->teams->contains($team)) {
        return redirect()->route('tournaments.show', $tournament->id)
            ->with('error', 'You have already signed up for this tournament.');
    }

    $tournament->teams()->attach($team);

    return redirect()->route('tournaments.show', $tournament->id)
        ->with('success', 'Signed up for the tournament successfully!');
}

public function startTournament($id)
{
    // Find the tournament
    $tournament = Tournament::findOrFail($id);

    // Ensure only the tournament creator or an admin can start the tournament
    if ($tournament->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Check if the tournament has already started
    if ($tournament->status !== 'Not_started') {
        return redirect()->back()->with('error', 'Tournament has already started.');
    }

    // Get all teams signed up for the tournament
    $teams = $tournament->teams;

    // Ensure there are at least 2 teams
    if ($teams->count() < 2) {
        return redirect()->back()->with('error', 'At least 2 teams are required to start a tournament.');
    }

    // Update tournament status
    $tournament->update(['status' => 'In_progress']);

    // Generate round-robin matches
    $this->generateRoundRobinMatches($tournament, $teams);

    return redirect()->route('tournaments.show', $tournament->id)
        ->with('success', 'Tournament started successfully!');
}

protected function generateRoundRobinMatches(Tournament $tournament, $teams)
{
    // Convert to array to make manipulation easier
    $teamArray = $teams->pluck('id')->toArray();
    $totalTeams = count($teamArray);

    // If odd number of teams, add a dummy team
    $addDummyTeam = $totalTeams % 2 != 0;
    if ($addDummyTeam) {
        $teamArray[] = null; // Represents a bye
        $totalTeams++;
    }

    // Generate matches
    for ($round = 1; $round < $totalTeams; $round++) {
        for ($match = 0; $match < $totalTeams / 2; $match++) {
            $home = $teamArray[$match];
            $away = $teamArray[$totalTeams - 1 - $match];

            // Skip matches with bye (null) team
            if ($home === null || $away === null) continue;

            // Create the match
            Matches::create([
                'tournament_id' => $tournament->id,
                'team1_id' => $home,
                'team2_id' => $away,
                'round' => $round,
                'status' => 'Pending'
            ]);
        }

        // Rotate the array, keeping the first team fixed
        $last = array_pop($teamArray);
        array_splice($teamArray, 1, 0, $last);
    }
}

    public function home(){
        $tournaments = Tournament::with('user')->where('user_id', auth()->id())->get();
        return view('index', compact('tournaments'));

    }

    public function dashboard(){
        $team = Team::where('user_id', Auth::id())->first();
        $user = Auth::user();
        $players = Player::where('team_id', $team)->get();
        return view('dashboard', compact('team',  'players', 'user'));
    }
    public function show($id)
    {
        $tournament = Tournament::with(['matches.team1', 'matches.team2', 'matches.winner', 'teams'])->findOrFail($id);
        $teams = $tournament->teams;

        // Add more detailed logging
        \Log::info('Tournament ID: ' . $tournament->id);
        \Log::info('Teams Count: ' . $teams->count());
        foreach ($teams as $team) {
            \Log::info('Team ID: ' . $team->id . ', Team Name: ' . $team->name);
        }

        $rounds = $tournament->matches->groupBy('round');
        return view('tournaments.show', compact('tournament', 'rounds', 'teams'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('tournaments.create', compact('teams'));
    }

    public function store(Request $request)
    {
        // dd($request);dd('hello there');
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            // 'teams' => 'required|array|min:2',
            // 'teams.*' => 'exists:teams,id',
        ]);

        $tournament = Tournament::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
            'user_id' => auth()->id(),
            'type' => 'single-elimination',
        ]);

        $tournament->teams()->attach($request->teams);

        return redirect()->route('tournaments.show', $tournament->id)
        ->with('success', 'Tournament created successfully!');
    }

    public function edit($id)
    {
        $tournament = Tournament::findOrFail($id);

        if ($tournament->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $teams = Team::all();
        return view('tournaments.edit', compact('tournament', 'teams'));
    }

    public function update(Request $request, $id)
    {
        $tournament = Tournament::findOrFail($id);

        if ($tournament->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'teams' => 'required|array|min:2',
            'teams.*' => 'exists:teams,id',
        ]);

        $tournament->update([
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);

        $tournament->teams()->sync($request->teams);

        return redirect()->route('tournaments.show', $tournament->id)
            ->with('success', 'Tournament updated successfully!');
    }

    public function destroy($id)
    {
        $tournament = Tournament::findOrFail($id);

        if ($tournament->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $tournament->delete();

        return redirect()->route('tournaments.index')
            ->with('success', 'Tournament deleted successfully!');
    }

    public function removeTeam(Tournament $tournament, Team $team)
    {
        if ($tournament->teams->contains($team)) {
            $tournament->teams()->detach($team);

            return redirect()->route('tournaments.edit', $tournament->id)
                ->with('success', 'Team removed from the tournament.');
        }

        return redirect()->route('tournaments.edit', $tournament->id)
            ->with('error', 'Team is not part of this tournament.');
    }
}
