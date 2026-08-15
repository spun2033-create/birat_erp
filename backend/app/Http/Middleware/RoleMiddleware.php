<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('role:admin') or ->middleware('role:admin,hr')
     */
    public function handle(Request $request, Closure $next, $roles = null)
    {
        $user = Auth::user();
        if (!$user) {
            // Not authenticated
            return redirect()->guest('/login');
        }

        if (!$roles) {
            return $next($request);
        }

        // roles can be comma separated
        $rolesArray = array_map('trim', explode(',', $roles));

        if ($user->hasRole($rolesArray)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
