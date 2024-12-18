<?php
namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function editForReferee($id)
{
    $match = Matches::with(['team1', 'team2', 'tournament'])->findOrFail($id);

    // Ensure only referees can access this
    if (!auth()->user()->hasRole('referee')) {
        abort(403, 'Unauthorized action.');
    }

    return view('matches.edit-referee', compact('match'));
}

public function updateForReferee(Request $request, $id)
{
    $match = Matches::findOrFail($id);

    // Ensure only referees can update
    if (!auth()->user()->hasRole('referee')) {
        abort(403, 'Unauthorized action.');
    }

    $validatedData = $request->validate([
        'team1_score' => 'required|integer|min:0',
        'team2_score' => 'required|integer|min:0',
    ]);

    // Determine the winner
    $winnerId = $validatedData['team1_score'] > $validatedData['team2_score']
        ? $match->team1_id
        : ($validatedData['team1_score'] < $validatedData['team2_score']
            ? $match->team2_id
            : null);

    $match->update([
        'team1_score' => $validatedData['team1_score'],
        'team2_score' => $validatedData['team2_score'],
        'winner_id' => $winnerId,
        'status' => 'Completed'
    ]);

    return redirect()->route('tournaments.show', $match->tournament_id)
        ->with('success', 'Match results updated successfully.');
    }
}
