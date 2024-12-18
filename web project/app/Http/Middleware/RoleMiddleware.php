<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        // Debug: Check if user exists and role matches
        if (!$user) {
            abort(403, 'Unauthorized: No user logged in');
        }

        if ($user->role !== $role) {
            abort(403, 'Unauthorized: Role mismatch. User role: ' . $user->role . ', Required role: ' . $role);
        }

        return $next($request);
    }
}
