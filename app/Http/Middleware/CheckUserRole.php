<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->role_id == $role) {
            return $next($request);
        }

        // If the user doesn't have the required role, redirect or abort as needed
        abort(403, 'Nesankcionēta piekļuve');
    }
}
