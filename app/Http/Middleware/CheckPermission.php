<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (! auth()->check()) {
            abort(403, 'Unauthenticated. Please log in.');
        }

        if (! auth()->user()->hasPermissionTo($permission)) {
            abort(403, "Unauthorized. You do not have the '{$permission}' permission.");
        }

        return $next($request);
    }
}
