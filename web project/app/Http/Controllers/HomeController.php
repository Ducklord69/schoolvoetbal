<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized: User is not logged in');
        }

        if ($user->role === 'admin') {
            return view('admin.dashboard'); // Admin-specific dashboard
        } elseif ($user->role === 'coach') {
            return view('coach.dashboard'); // Coach-specific dashboard
        } elseif ($user->role === 'referee') {
            return view('referee.dashboard'); // Referee-specific dashboard
        }

        abort(403, 'Unauthorized: Role not recognized');
    }



}
